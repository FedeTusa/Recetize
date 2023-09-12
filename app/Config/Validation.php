<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    public $paciente = [
        'dni' => 'required|min_length[8]|max_length[8]|is_natural_no_zero',
        'nombre' => 'required|min_length[3]|max_length[50]|alpha',
        'apellido' => 'required|min_length[2]|max_length[50]|alpha',
        'celular' => 'required|min_length[8]|max_length[11]|is_natural_no_zero',
        'localidad' => 'required|min_length[2]|max_length[50]',
        'calle' => 'required|min_length[2]|max_length[30]',
        'altura' => 'required|is_natural_no_zero'
    ];

    public $medico = [
        'matricula' => 'required|min_length[2]|max_length[50]|is_natural_no_zero',
        'nombre' => 'required|min_length[3]|max_length[50]|alpha',
        'apellido' => 'required|min_length[2]|max_length[50]|alpha',
        'especialidad' => 'required|min_length[4]|max_length[30]|alpha',
        'localidad' => 'required|min_length[2]|max_length[50]'
    ];

    public $remedio = [
        'codigo' => 'required|min_length[2]|max_length[50]|is_natural_no_zero',
        'droga' => 'required|min_length[3]|max_length[50]|alpha',
        //'medicamento' => 'max_length[50]|alpha'
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
}
