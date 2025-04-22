# Docker Postfix

### Docker compose ENV options

```dotenv
COMPOSE_BAKE=true

PORT="127.0.0.1:1025"
HOSTNAME="panservice.it"
NETWORKS="172.28.0.0/24"
TIMEZONE="Europe/Rome"
```

### Expose container to others networks

```env
...
    networks:
      - net1
      - net2
      - net3
networks:
  net1:
    external: true
  net2:
    external: true
  net3:
    external: true
```

### Build and start container

```bash
docker compose build --no-cache postfix
```

```bash
docker compose up -d
```

### Using into Docker container

```php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'host.docker.internal';
$mail->Port = 1025;

$mail->SMTPAutoTLS = false;
$mail->SMTPSecure = false;

$mail->setFrom('noreply@panservice.it', 'Panservice');
$mail->addAddress('info@panservice.it');

$mail->Subject = 'Panservice - E-mail SMTP check';
$mail->Body = 'E-mail sent with success!';

$mail->send();
```

### Postfix testing client

**Using parameters with explicit flags**:
- `--from`: Set "from" e-mail address.
- `--fromName`: Set "from" e-mail name.
- `--recipient`: Recipient e-mail.
- `--host` (optional): Set SMTP host.
- `--port` (optional): Set SMTP port.

**Installing dependencies**: 

```bash
cd client && composer install
```

**Example usage**:

```bash
php client/send.php --from="noreply@panservice.it" \
	--fromName="Panservice" \
	--recipient="info@panservice.it" \
	--host="localhost" \
	--port=1025
```

### About Panservice

<strong><i>Costruiamo servizi internet su misura da oltre 25 anni</i></strong>

Da oltre venticinque anni ci occupiamo di
telecomunicazioni e soluzioni ICT costruendo e
fornendo servizi digitali che si adattano alle esigenze del
cliente, e ci distinguiamo per la qualità dei servizi e del supporto
offerto ai nostri clienti.

Fin dagli anni ‘90 abbiamo compreso come Internet avrebbe rivoluzionato
le modalità con cui cittadini ed imprese avrebbero interagito fra loro e
con la Pubblica Amministrazione divenendo il cuore del moderno scambio di
informazioni e per questo continuiamo ad investire per realizzare infrastrutture
gestite in proprio.

Panservice è autorizzata alla fornitura di servizi di Comunicazione Elettronica (accesso ad
internet), servizi di Telefonia Vocale, servizi VoIP, servizi di accesso R-Lan (WISP), fornitura di
reti e servizi di comunicazione elettronica ad uso pubblico (installazione ed esercizio di rete di
accesso in fibra ottica e ponti radio), ed è iscritta al Registro degli Operatori di
Comunicazione al numero 8209.

La nostra rete tocca le città di Latina, sede del data center, Roma e Milano (in anello). E’ in corso di attivazione 
un anello N x 400 Gbit/s in fibra fra Latina, Frosinone, Roma.

Grazie a questa topologia il datacenter da cui vengono erogati i servizi, posto sull’anello, è interconnesso ad elevatissima 
capacità con i maggiori punti di interscambio nazionali, il Namex a Roma, il MIX ed il Minap di Via Caldera a Milano ed 
il PCIX di Piacenza, dove avvengono i peering diretti verso quasi quattrocento reti di altri operatori nazionali e 
internazionali nonché le interconnessioni di transito internazionale. Il data center è comunque carrier-neutral.

Il datacenter di Latina è inoltre interconnesso localmente con tratte in fibra ottica a centrali di TIM (3 centrali), Openfiber e Wind.

L’interconnessione verso internet, multihomed e multipath, è gestita tramite protocollo BGP, supporta IPv4 ed IPv6, ed ha 
un AS_Path inferiore a 3 hop verso la maggior parte delle destinazioni nazionali ed internazionali.

La rete è continuamente monitorata e viene gestita proattivamente da personale interno.

* <a href="https://www.panservice.it" target="_blank">https://www.panservice.it</a>
* <a href="https://www.olo2olo.it" target="_blank">https://www.olo2olo.it</a>
* <a href="https://datacenter.panservice.it" target="_blank">https://datacenter.panservice.it</a>
