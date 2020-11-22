<?php
/**
 * User: Dieudonnne Takougang
 * Date: 22/11/2020
 */

namespace App\Services\Interfaces;


interface UtilityServiceInterface
{
    public function addSessionData($key, $data);

    public function getSessionDataByKey($key);

    public function hasSessionValue($key);

    public function forgetSessionByKey($key);

    public function clearSession();

    public function getCurrentLoggedUser();
}