Ao instalar o plugin, criar a seguinte estrutura de diretórios dentro do uploads:

wpsc/
├── category_images
├── downloadables
├── previews
├── product_images
│   └── thumbnails
└── upgrades

Atribuir permissões de escrita e leitura ao diretório wpsc e seus filhos.


---- Executar a consulta abaixo para corrigir o código de moeda ----

UPDATE `ethymos_cintaliga`.`wp_wpsc_currency_list` SET `country` = 'Brasil',
`currency` = 'Real Brasileiro',
`symbol` = 'R$',
`symbol_html` = 'R&#036;' WHERE `wp_wpsc_currency_list`.`id` =107 LIMIT 1 ;