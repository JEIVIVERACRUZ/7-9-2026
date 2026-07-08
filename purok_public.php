<?php
// ============================================================
// api/puroks_public.php — Returns zone/purok boundaries only
// (admin markers are excluded so residents never see them)
// ============================================================
session_start();
require_once '../includes/db.php';

if (empty($_SESSION['admin_id']) && empty($_SESSION['resident_id'])) {
    jsonError('Unauthorized', 401);
}

$zones = dbFetchAll(
    "SELECT id, name, description, color, coordinates, resident_count
     FROM puroks
     WHERE type='zone'
     ORDER BY name"
);

header('Content-Type: application/json');
echo json_encode(['success' => true, 'zones' => $zones]);