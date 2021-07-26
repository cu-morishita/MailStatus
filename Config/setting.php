<?php
$config = [
	'MailStatus' => [
		'colors'	=> [
			'#808080' => '#808080',
			'#C0C0C0' => '#C0C0C0',
			'#FFFFFF' => '#FFFFFF',
			'#0000FF' => '#0000FF',
			'#000080' => '#000080',
			'#008080' => '#008080',
			'#008000' => '#008000',
			'#00FF00' => '#00FF00',
			'#00FFFF' => '#00FFFF',
			'#FFFF00' => '#FFFF00',
			'#FF0000' => '#FF0000',
			'#FF00FF' => '#FF00FF',
			'#808000' => '#808000',
			'#800080' => '#800080',
			'#800000' => '#800000',
			'#000000' => '#000000',
		]
	],
	'BcApp.adminNavigation' => [
		'Contents' => [
			'MailStatus' => [
				'name'		=> '受信メールステータス プラグイン',
				'title' => '受信メールステータス プラグイン',
				'type' => 'mail_status',
				'icon' => 'bca-icon--banner',
				'menus'	=> [
					[
						'title' => 'メールステータス一覧',
						'url' => [
							'admin' => true,
							'plugin' => 'mail_status',
							'controller' => 'mail_status',
							'action' => 'index'
						]
					],
					[
						'title' => 'メールステータス新規登録',
						'url' => [
							'admin' => true,
							'plugin' => 'mail_status',
							'controller' => 'mail_status',
							'action' => 'add'
						]
					],
				],
			]
		],
	]
];
