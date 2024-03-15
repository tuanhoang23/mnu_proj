<?php
use App\Models\Groups;

function getAllGroup(){
    $group = new Groups();
    return $group->getAll();
}