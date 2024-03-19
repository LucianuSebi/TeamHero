<?php
session_start();
$roles["user"] = [
    "edit_user_skills" => "no",
    "edit_skills_org" => "no",
    "see_stats" => "no",
    "edit_projects_org" => "no",
    "edit_user_settings" => "no",
];
$roles["projM"] = [
    "edit_user_skills" => "no",
    "edit_skills_org" => "no",
    "see_stats" => "no",
    "edit_projects_org" => "no",
    "edit_user_settings" => "no",
];
$roles["deptM"] = [
    "edit_user_skills" => "yes",
    "edit_skills_org" => "yes",
    "see_stats" => "yes",
    "edit_projects_org" => "no",
    "edit_user_settings" => "no",

];
$roles["admin"] = [
    "edit_user_skills" => "yes",
    "edit_skills_org" => "yes",
    "see_stats" => "yes",
    "edit_projects_org" => "yes",
    "edit_user_settings" => "yes",

];