<?php return array(
    'root' => array(
        'name' => '__root__',
        'pretty_version' => '1.0.0+no-version-set',
        'version' => '1.0.0.0',
        'reference' => NULL,
        'type' => 'library',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'dev' => true,
    ),
    'versions' => array(
        '__root__' => array(
            'pretty_version' => '1.0.0+no-version-set',
            'version' => '1.0.0.0',
            'reference' => NULL,
            'type' => 'library',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'twbs/bootstrap' => array(
            'pretty_version' => 'v5.0.2',
            'version' => '5.0.2.0',
            'reference' => '688bce4fa695cc360a0d084e34f029b0c192b223',
            'type' => 'library',
            'install_path' => __DIR__ . '/../twbs/bootstrap',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'twbs/bootstrap-icons' => array(
            'pretty_version' => 'v1.11.1',
            'version' => '1.11.1.0',
            'reference' => '8d7bc695fb407627378cb184976b348e6a128d59',
            'type' => 'library',
            'install_path' => __DIR__ . '/../twbs/bootstrap-icons',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'twitter/bootstrap' => array(
            'dev_requirement' => false,
            'replaced' => array(
                0 => 'v5.0.2',
            ),
        ),
    ),
);
