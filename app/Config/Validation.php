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

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    public $registration = [
        'username' => [
            'label' => 'Auth.username',
            'rules' => [
                'required',
                'max_length[30]',
                'min_length[3]',
                'regex_match[/\A[a-zA-Z0-9\.]+\z/]',
                'is_unique[users.username]',
            ],
        ],
        'first_name' => [
            'label' => 'First Name',
            'rules' => [
                // 'max_length[10]',
                // 'min_length[1]',
                // 'regex_match[/^[a-zA-Z]+$/]',
            ],
        ],
        'last_name' => [
            'label' => 'Last Name',
            'rules' => [
                // 'max_length[10]',
                // 'min_length[1]',
                // 'regex_match[/^[a-zA-Z]+$/]',
            ],
        ],
        'phone' => [
            'label' => 'Mobile Number',
            'rules' => [
                // 'max_length[20]',
                // 'min_length[10]',
                'regex_match[/\A[0-9]+\z/]',
                'is_unique[users.phone]',
            ],
        ],
        'email' => [
            'label' => 'Auth.email',
            'rules' => [
                'required',
                'max_length[254]',
                'valid_email',
                'is_unique[auth_identities.secret]',
            ],
        ],
        'password' => [
            'label' => 'Auth.password',
            'rules' => [
                'required',
                'max_byte[72]',
                'strong_password[]',
            ],
            'errors' => [
                'max_byte' => 'Auth.errorPasswordTooLongBytes',
            ]
        ],
        'password_confirm' => [
            'label' => 'Auth.passwordConfirm',
            'rules' => 'required|matches[password]',
        ],
    ];

    //Rules for validating Users
    public array $uservalidation = [
        'first_name' => [
            'label' => 'First Name',
            'rules' => 'required',
            'errors' => [
                'required' => 'You must specify the {field} of the user'
            ]
        ],
        'last_name' => [
            'label' => 'Last Name',
            'rules' => 'required',
            'errors' => [
                'required' => 'You must specify the {field} of the user'
            ]
        ],
        'phone' => [
            'label' => 'Phone Number',
            'rules' => 'required',
            'errors' => [
                'required' => 'You must specify the {field} of the user'
            ]
        ],
        'email' => [
            'label' => 'Email Address',
            'rules' => 'required|valid_email|is_unique[auth_identities.secret]',
            'errors' => [
                'required' => 'You must specify the {field} of the user',
                'valid_email' => 'You need to specify a valid {field}',
                'is_unique' => 'The specified {field} has already regisetred another user',
            ]
        ],
        'username' => [
            'label' => 'Username',
            'rules' => 'required|is_unique[users.username]',
            'errors' => [
                'required' => 'You must specify the {field} of the user',
                'is_unique' => 'The specified {field} has already regisetred another user',
            ]
        ],
        'group' => [
            'label' => 'User Group',
            'rules' => 'required',
            'errors' => [
                'required' => 'You must specify the {field} of the user'
            ]
        ],
        'password' => [
            'label' => 'Password',
            'rules' => 'required',
            'errors' => [
                'required' => 'You must specify the {field} of the user'
            ]
        ],
        'cpassword' => [
            'label' => 'Confirm Password',
            'rules' => 'required|matches[password]',
            'errors' => [
                'required' => 'You must specify the {field} of the user',
                'matches' => '{field} and password must match'
            ]
        ],
    ];
}
