<?php

return [
    'brand' => [
        'subtitle' => "IP information's Tool",
    ],
    'ip' => [
        'card' => [
            'error' => 'An error occurred in receiving information. Click the button below to try again.',
            'retry' => 'Try again',
        ],
        'info' => [
            'title' => 'Your IP:',
            'btn' => 'Public',
            'location' => 'Location',
            'subnet' => 'Subnet',
        ],
        'table' => [
            'title' => 'Your IP Information:',
            'ip' => 'IP Address',
            'ip_numeric' => 'Numeric IP Address',
            'country' => 'Country',
            'longitude' => 'Longitude',
            'latitude' => 'Latitude',
            'asn' => 'ASN',
            'asn_org' => 'ASN (organization)',
            'hostname' => 'Hostname',
            'user_agent' => 'User agent',
            'user_agent_comment' => 'User agent: Comment',
            'user_agent_raw' => 'User agent: Raw',
        ],
        'api' => [
            'title' => 'How to use our API!',
            'subtitle' => 'Through the following options, you can see how to use each item and its result:',
            'items' => [
                'ip' => 'IP',
                'country' => 'Country',
                'country_code' => 'Country code',
                'city' => 'City',
                'asn' => 'ASN',
                'json' => 'JSON',
            ],
            'input' => [
                'title' => 'Check IP (Optional)',
                'check' => 'Check',
                'placeholder' => 'Your IP',
            ],
            'result_error' => 'Error! Please try again later',
            'copied' => 'Copied',
        ],
    ],
    'faq' => [
        'title' => 'FAQ',
        'questions' => [
            'How can I determine which version of IP to use?',
            'How can I get this information in JSON format?',
            'Is it allowed to use this tool in programs?',
            'Can I launch this tool exclusively for myself?',
        ],
        'answers' => [
            'Since 2018-07-25, specifying the IP version in protocols is obsolete and not possible. But if possible, you can determine the IP version by using the correct parameter in the program you are using. For example, in the curl command, you can specify which IP version you have to be used with parameters -4 and -6.',
            'By setting the request header parameter equal to application/json, you can receive the information in JSON format.',
            'Yes, as long as the number of your requests does not exceed a certain limit and does not create pressure on our servers, you can use this tool in the programs. In your programs, try not to send more than one request per minute. If your requests increase, you will be prevented from creating a new request for some time.',
            'Yes, you can contact us using the contact numbers and we will set up your own dedicated tool.',
        ],
    ],
    'contact' => [
        'title' => 'Contact Us',
        'phone' => 'Phone:',
        'email' => 'Email:',
        'support' => 'Support:',
        'click' => 'Click here',
    ],
    'links' => [
        'title' => 'Follow Us:',
        'dnj' => 'DNJ Holding',
        'jey' => 'Jey Server',
        'webshot' => 'WebShot',
        'jeodns' => 'JeoDNS',
    ],
];
