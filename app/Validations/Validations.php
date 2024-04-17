<?php

namespace App\Validations;

class Validations {

    public function validateCpf(string $cpf, string &$error = null): bool {

        $cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);
        // Checks if none of the sequences below were entered, if so, returns false
        if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {

            $error = 'Please enter a valid CPF';
            return FALSE;
        } else {
            // Calculate the numbers to check if the CPF is true
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf[$c] * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    $error = 'Please enter a valid CPF';
                    return FALSE;
                }
            }
            return TRUE;
        }
    }
}