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

$color->createColor('Red', '#FF0000', '#8B0000', '#B22222', '#DC143C');
$color->createColor('Green', '#008000', '#006400', '#228B22', '#2E8B57');
$color->createColor('Blue', '#0000FF', '#00008B', '#0000CD', '#1E90FF');

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