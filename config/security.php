<?php
    return [
        'routes_prelogin' => [
            'login', 'index', 'register'
        ],
        'routes_poslogin' => [
            'index', 'logout', 'usermanagement', 'bookmanagement', 'loanmanagement',
            'user.destroy', 'book.destroy', 'loan.destroy'
        ],
    ];