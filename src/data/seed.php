<?php

require_once __DIR__ . '/../model/Color.php';
require_once __DIR__ . '/../model/License.php';
require_once __DIR__ . '/../model/UserModel.php';
require_once __DIR__ . '/../Logger.php';
$logger = new Logger();

use model\Color;
use model\License;
use model\UserModel;

$color = new Color();
$license = new License();
$user = new UserModel();

$user->addUser('admin', 'admin', '12341234');

/* claire , moins claire, accent, foncée */
$color->createColor('Cv Creator', 'https://s3-alpha.figma.com/thumbnails/abd13535-fec5-4f7e-a21e-7d1db9951b85?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAQ4GOSFWCXOFPMXWY%2F20240208%2Fus-west-2%2Fs3%2Faws4_request&X-Amz-Date=20240208T000000Z&X-Amz-Expires=604800&X-Amz-SignedHeaders=host&X-Amz-Signature=27f7fc9dea4997cea4ba9ff013b1b86b5d8c0c1a7544cd1912ed825b57a0116f', '#F2E2C2', '#DEB472', '#454545', '#231711');
$color->createColor('Soft carpet', 'https://mir-s3-cdn-cf.behance.net/projects/202/e72dee175675585.Y3JvcCwxNzAxLDEzMzEsMTQ3LDA.jpg', '#A69C8A', '#8C8372', '#403529', '#0D0D0D');
$color->createColor('Light clouds', 'https://mir-s3-cdn-cf.behance.net/projects/202/30155a188190495.Y3JvcCwxMjAwLDkzOCwwLDE2Ng.jpg', '#F0F0F2', '#D2D3D9', '#A6A26D', '#735C3F');
$color->createColor('Blue accent', 'https://mir-s3-cdn-cf.behance.net/projects/202/4a9cec189838189.Y3JvcCwyNzUwLDIxNTAsMCwxNzIy.jpg', '#A69494', '#6C748C', '#A61C35', '#2A3140');

$license->createLicense('AM', 'Cyclomoteurs');
$license->createLicense('A1', 'Moto légère');
$license->createLicense('A2', 'Moto < 35kW');
$license->createLicense('A', 'Moto toutes catégories');
$license->createLicense('B', 'Voitures');
$license->createLicense('BE', 'Voiture + remorque lourde');
$license->createLicense('B1', 'Quadricycles lourds');
$license->createLicense('C', 'Poids lourds');
$license->createLicense('CE', 'Poids lourds + remorque');
$license->createLicense('D', 'Transport en commun');
$license->createLicense('DE', 'Transport en commun + remorque');
$license->createLicense('D1', 'Minibus');
$license->createLicense('D1E', 'Minibus + remorque');
/* flemme de mettre bateau, avion et tout */

$logger->log('Data seeded successfully (yayx!)');