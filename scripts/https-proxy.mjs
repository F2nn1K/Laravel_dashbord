import https from 'https';
import httpProxy from 'http-proxy';
import selfsigned from 'selfsigned';

const target = 'http://127.0.0.1:8000';
const listenPort = 8001;

const attrs = [{ name: 'commonName', value: 'localhost' }];
const pems = selfsigned.generate(attrs, {
	algorithm: 'sha256',
	days: 3650,
	keySize: 2048,
	extensions: [{ name: 'subjectAltName', altNames: [
		{ type: 2, value: 'localhost' },
		{ type: 7, ip: '127.0.0.1' },
	]},],
});

const proxy = httpProxy.createProxyServer({
	target,
	changeOrigin: true,
	secure: false,
});

proxy.on('error', (err, req, res) => {
	res.writeHead(502, { 'Content-Type': 'text/plain' });
	res.end('Proxy error: ' + err.message);
});

https.createServer({ key: pems.private, cert: pems.cert }, (req, res) => {
	proxy.web(req, res);
}).listen(listenPort, () => {
	console.log(`HTTPS proxy listening on https://localhost:${listenPort} -> ${target}`);
});

