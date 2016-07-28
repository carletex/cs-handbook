<?php 

/**
 * 1. Create a hash map for a contact list (phone numbers as
 * keys, names as value).
 */

include_once './map_hash_map.php';

$agenda = new HashMap();

// Insert contacts
$agenda->put('687598685', 'John');
$agenda->put('987595652', 'Kelly');
$agenda->put('962237851', 'Preston');
$agenda->put('622574256', 'Carlos');
$agenda->put('668922551', 'Tony');
$agenda->put('652221546', 'Alfred');

// Remove contacts
$agenda->remove('687598685');

// Get contacts
$name = $agenda->get('668922551')->value;

print '<pre>';
print '<h1>Agenda</h1>';
print_r($agenda);
print '</pre>';
