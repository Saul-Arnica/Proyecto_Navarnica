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
     * @var list<string>
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

    public $contacto = [
        'nombre' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'El nombre es obligatorio.',
                'min_length' => 'El nombre debe tener al menos 3 caracteres.'
            ]
            ],
        'email' => [
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => 'El email es obligatorio.',
                'valid_email' => 'El email no es válido.'
            ]
        ],
        'mensaje' => [
            'rules' => 'required|min_length[10]',
            'errors' => [
                'required' => 'El mensaje es obligatorio.',
                'min_length' => 'El mensaje debe tener al menos 10 caracteres.'
            ]
            ],
        ];

        
    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
}
