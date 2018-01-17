<?php
/**
 * Created by PhpStorm.
 * User: shobl
 * Date: 1/8/2018
 * Time: 2:29 PM
 */
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$postJSON = file_get_contents('php://input');
$post = json_decode($postJSON, TRUE);

$PAGEACCESS = true;
require_once ('./connect.php');
//require_once('../file_upload/aws_s3/credential.php');


$output = [
    'success' => false,
    'data' => [],
    'errors' => [],
];

if(empty($_GET['action'])){
    $_GET['action'] = 'get';
}
if(empty($_GET['resource'])){
    $_GET['action'] = 'pets';
}

switch($_GET['action']) {
    case 'get':
        switch ($_GET['resource']) {
            case 'pets': {
                if (empty($_GET['petID'])) {
                    //require('actions/pull_pet_records.php?ID=1');


                    require('./actions/pull_users_pets.php');
                } else {
                    //pull all pet records
                }
                break;
            }
            case 'record-item': {
                if (!empty($_GET['recordID'])) {
                    require('./actions/fetch_single_record_item.php');
                } else {
                    //pulls all record items
                    require('./actions/fetch_record_items.php');
                }
                break;
            }
            case 'client_list': {
                if (!empty($_GET['vetID'])) {
                    require('./actions/read_vets_owners.php');
                }
            }
            case 'pets_for_vet': {
                if (!empty($_GET['ownerID']) && !empty($_GET['vetID'])) {
                    require('./actions/read_client_pets_for_vet.php');
                }
            }

        }
    case 'post':
        switch ($_GET['resource']) {
            case 'record-item':
                if (!empty($post)) {
                    require('./actions/add_record_item.php');
                }
                break;
            case 'login':
                if (!empty($post)) {
                    require('./actions/login.php');
                }
                break;
            case 'vetlogin':
                if (!empty($post)) {
                    require('./actions/vet_login.php');
                }
                break;

            case 'pet':
                if (!empty($post)) {
                    require('./actions/add_pet.php');
                }
                break;
            case 'deletePet':
                if (!empty($post)) {
                    require('./actions/soft_delete_pet.php');
                }
                break;

            case 'register':
                if (!empty($post)) {
                    require('./actions/add_user.php');
                }
                break;

            case 'upload-item': {
                if (empty($post)) {
                    require('../file_upload/aws_s3/page.php');
                }
                break;
            }
            case 'deleteRecord': {
                if (!empty($post)) {
                    require('./actions/soft_delete_record.php');
                }
                break;
            }
            case 'registerVet': {
                if (!empty($post)) {
                    require('./actions/add_vet.php');
                }
                break;
            }
            case 'editMedicalRecord': {
                if (!empty($post)) {
                    require('./actions/edit_medical_record.php');

                }
                break;
            }
            case 'petVetConnect': {
                if (!empty($post)) {
                    require('./actions/connect_pet_to_vet.php');
                }
            }
        }

    }

if (isset($pet_objects)) {
    $output['data'] = $pet_objects;
}

$json_output = json_encode($output);

print($json_output);
