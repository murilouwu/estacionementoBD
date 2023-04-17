<?php
	session_start();
	include('config.php');
	$usuarios = array(
	   	array(
	        "nm_nome" => "Aline Souza Santos",
	        "nm_name" => "alinesouza",
	        "mail_user" => "aline.souza@gmail.com",
	        "dt_nasc" => "1995-05-20",
	        "des_endereco" => "Rua das Palmeiras, 321",
	        "nr_tel" => "21_5867-7584",
	        "sl_adm" => 0
	    ),
	    array(
	        "nm_nome" => "Allison Taylor Mitchell",
	        "nm_name" => "allisonmitchell",
	        "mail_user" => "allison.mitchell@gmail.com",
	        "dt_nasc" => "1992-03-15",
	        "des_endereco" => "Avenida das Flores, 456",
	        "nr_tel" => "34_8965-4596",
	        "sl_adm" => 0
	    ),
	    array(
	        "nm_nome" => "Ana Carolina Silva",
	        "nm_name" => "anacarolsilva",
	        "mail_user" => "ana.carol.silva@gmail.com",
	        "dt_nasc" => "1998-07-10",
	        "des_endereco" => "Rua dos Pinheiros, 789",
	        "nr_tel" => "11_7465-6721",
	        "sl_adm" => 0
	    ),
	    array(
	        "nm_nome" => "Beatriz Fernandes Costa",
	        "nm_name" => "beatrizcosta",
	        "mail_user" => "beatriz.costa@gmail.com",
	        "dt_nasc" => "1994-09-25",
	        "des_endereco" => "Rua dos Coqueiros, 234",
	        "nr_tel" => "42_3654-7819",
	        "sl_adm" => 0
	    ),
	    array(
	        "nm_nome" => "Benjamin Thomas Walker",
	        "nm_name" => "benjaminwalker",
	        "mail_user" => "benjamin.walker@gmail.com",
	        "dt_nasc" => "1997-02-18",
	        "des_endereco" => "Avenida dos Jacarandás, 567",
	        "nr_tel" => "16_5867-5481",
	        "sl_adm" => 0
	    ),
	    array(
	        "nm_nome" => "Caio Mendes Pereira",
	        "nm_name" => "caiomp",
	        "mail_user" => "caiomp@gmail.com",
	        "dt_nasc" => "1995-07-12",
	        "des_endereco" => "Rua dos Ipês, 123",
	        "nr_tel" => "62_8965-5487",
	        "sl_adm" => 0
	    ),
	    array(
	        "nm_nome" => "Camila Oliveira Santos",
	        "nm_name" => "camilasantos",
	        "mail_user" => "camilasantos@hotmail.com",
	        "dt_nasc" => "1990-05-15",
	        "des_endereco" => "Avenida Paulista, 456",
	        "nr_tel" => "21_5867-8542",
	        "sl_adm" => 0
	    ),
	    array(
	        "nm_nome" => "Caroline Elizabeth Davis",
	        "nm_name" => "carolinedavis",
	        "mail_user" => "carolinedavis@gmail.com",
	        "dt_nasc" => "1988-12-01",
	        "des_endereco" => "Rua dos Cravos, 789",
	        "nr_tel" => "47_8965-3654",
	        "sl_adm" => 0
	    ),
	    array(
	        "nm_nome" => "Daniela Lima Silva",
	        "nm_name" => "danilasilva",
	        "mail_user" => "danilasilva@hotmail.com",
	        "dt_nasc" => "1992-02-29",
	        "des_endereco" => "Rua das Rosas, 321",
	        "nr_tel" => "27_7845-5687",
	        "sl_adm" => 0
	    ),
	    array(
	        "nm_nome" => "Daniel Ferreira Costa",
	        "nm_name" => "danfc",
	        "mail_user" => "danfc@gmail.com",
	        "dt_nasc" => "1985-11-15",
	        "des_endereco" => "Rua dos Girassóis, 789",
	        "nr_tel" => "31_8976-5790",
	        "sl_adm" => 0
	    ),
	    array(
	        "nm_nome" => "David Michael Anderson",
	        "nm_name" => "davidma",
	        "mail_user" => "davidma@gmail.com",
	        "dt_nasc" => "1986-06-30",
	        "des_endereco" => "Avenida das Américas, 1234",
	        "nr_tel" => "91_9867-6848",
	        "sl_adm" => 0
	    ),
	    array(
	        "nm_nome" => "Érica Alves Souza",
	        "nm_name" => "ericaalvess",
	        "mail_user" => "ericaalvess@hotmail.com",
	        "dt_nasc" => "1991-09-22",
	        "des_endereco" => "Rua dos Jasmins, 456",
	        "nr_tel" => "53_8475-6732",
	        "sl_adm" => 0
	    ),
	    array(
	        "nm_nome" => "Eduardo Castro Almeida",
	        "nm_name" => "eduardocastro",
	        "mail_user" => "eduardo.castro@gmail.com",
	        "dt_nasc" => "1985-05-12",
	        "des_endereco" => "Av. Paulista, 1234",
	        "nr_tel" => "75_7854-6896",
	        "sl_adm" => 0
	    ),
	    array(
	        "nm_nome" => "Emily Grace Williams",
	        "nm_name" => "emilywilliams",
	        "mail_user" => "emily.williams@gmail.com",
	        "dt_nasc" => "1992-11-22",
	        "des_endereco" => "Rua dos Lírios, 567",
	        "nr_tel" => "14_5867-5462",
	        "sl_adm" => 0
	    ),
	    array(
	        "nm_nome" => "Fabiana Ribeiro Lima",
	        "nm_name" => "fabianalima",
	        "mail_user" => "fabiana.lima@gmail.com",
	        "dt_nasc" => "1988-09-15",
	        "des_endereco" => "Rua das Rosas, 789",
	        "nr_tel" => "35_8965-6451",
	        "sl_adm" => 0
	    ),
	    array(
	        "nm_nome" => "Franklin James Carter",
	        "nm_name" => "franklincarter",
	        "mail_user" => "franklin.carter@gmail.com",
	        "dt_nasc" => "1983-03-04",
	        "des_endereco" => "Av. Rio Branco, 432",
	        "nr_tel" => "81_3876-5462",
	        "sl_adm" => 0
	    ),
	    array(
	        "nm_nome" => "Gabriel Cardoso Santos",
	        "nm_name" => "gabriel.santos",
	        "mail_user" => "gabriel.santos@gmail.com",
	        "dt_nasc" => "1995-06-21",
	        "des_endereco" => "Rua das Flores, 123",
	        "nr_tel" => "47_8654-7845",
	        "sl_adm" => 0
	    ),
	    array(
	        "nm_nome" => "Grace Victoria Young",
	        "nm_name" => "grace.young",
	        "mail_user" => "grace.young@gmail.com",
	        "dt_nasc" => "1992-09-14",
	        "des_endereco" => "Rua das Árvores, 456",
	        "nr_tel" => "55_3678-5432",
	        "sl_adm" => 0
	    ),
	    array(
	        "nm_nome" => "Heloísa da Silva Oliveira",
	        "nm_name" => "heloisa.oliveira",
	        "mail_user" => "heloisa.oliveira@gmail.com",
	        "dt_nasc" => "1990-11-28",
	        "des_endereco" => "Rua dos Pássaros, 789",
	        "nr_tel" => "48_6845-7896",
	        "sl_adm" => 0
	    ),
	    array(
	        "nm_nome" => "Henry Charles Edwards",
	        "nm_name" => "henry.edwards",
	        "mail_user" => "henry.edwards@gmail.com",
	        "dt_nasc" => "1987-03-08",
	        "des_endereco" => "Av. das Estrelas, 147",
	        "nr_tel" => "16_5867-4512",
	        "sl_adm" => 0
	    ),
	    array(
	        "nm_nome" => "Isabella da Costa e Silva",
	        "nm_name" => "isabella.silva",
	        "mail_user" => "isabella.silva@gmail.com",
	        "dt_nasc" => "1998-02-12",
	        "des_endereco" => "Rua das Montanhas, 753",
	        "nr_tel" => "81_4865-5364",
	        "sl_adm" => 0
	    ),
	    array(
	        "nm_nome" => "Isabella Marie Martinez",
	        "nm_name" => "isabella.martinez",
	        "mail_user" => "isabella.martinez@gmail.com",
	        "dt_nasc" => "1994-07-07",
	        "des_endereco" => "Av. das Rosas, 852",
	        "nr_tel" => "32_9876-5423",
	        "sl_adm" => 0
	    ),
	    array(
	        "nm_nome" => "Jackson Lee Cooper",
	        "nm_name" => "jackson.cooper",
	        "mail_user" => "jackson.cooper@gmail.com",
	        "dt_nasc" => "1985-12-16",
	        "des_endereco" => "Rua dos Lagos, 159",
	        "nr_tel" => "68_5467-6857",
	        "sl_adm" => 0
	    ),
	    array(
	        "nm_nome" => "Sukuna Misoshi",
	        "nm_name" => "Sukuna",
	        "mail_user" => "Sukuna@gmail.com",
	        "dt_nasc" => "1995-05-10",
	        "des_endereco" => "Rua das Flores, 123",
	        "nr_tel" => "62_6974-5487",
	        "sl_adm" => 0
	    ),
	    array(
	        "nm_nome" => "Satoru Gojo",
	        "nm_name" => "Satoru",
	        "mail_user" => "muriokujo@gmail.com",
	        "dt_nasc" => "1992-12-25",
	        "des_endereco" => "Avenida Paulista, 1000",
	        "nr_tel" => "55_3475-6730",
	        "sl_adm" => 1
	    )
	);
	//Cria todos os usuarios
	for ($i=0; $i<count($usuarios); $i++) { 
		$senha = $usuarios[$i]['nm_name'].$usuarios[$i]['mail_user'].'Pass';
		$file = array();
		$file['tmp_name'] = '';
		$dados = array(
			$file,//0
			$usuarios[$i]['nm_name'],//1 nome de usuario
			$usuarios[$i]['nm_nome'],//2 nome completo
			Cripto($senha),//3 senha
			$usuarios[$i]['mail_user'],//4 email
			$usuarios[$i]['nr_tel'],//5 Nrm tel
			$usuarios[$i]['des_endereco'],//6 endereço
			$usuarios[$i]['dt_nasc']//7 data De Nascimento
		);
		$des = CadUser($dados[1], $dados[2], $dados[4], $dados[7], $dados[6], $dados[3], $dados[5], $dados[0], $usuarios[$i]['sl_adm']);
		$des = '';
	}
	$estacionamentos = array(
		array(
		    'nm_name' => 'EstacionamentoA',
		    'des_endereco' => 'Rua A, 123',
		    'vl_dia' => 150.00,
		    'vl_con' => 25.00,
		    'vl_men' => 500.00
		),
		array(
		    'nm_name' => 'EstacionamentoB',
		    'des_endereco' => 'Rua B, 456',
		    'vl_dia' => 250.00,
		    'vl_con' => 25.00,
		    'vl_men' => 600.00
		)
	); 
	$datas = array(
		array(
		    'dt_disp' => '2023-04-20',
		    'preco' => 20.00,
		    'id_esta' => 0
		),
		array(
		    'dt_disp' => '2023-04-21',
		    'preco' => 25.00,
		    'id_esta' => 0
		),
		array(
		    'dt_disp' => '2023-04-20',
		    'preco' => 22.50,
		    'id_esta' => 1
		),
		array(
		    'dt_disp' => '2023-04-21',
		    'preco' => 28.50,
		    'id_esta' => 1
		)
	);
	for ($i=0; $i<count($estacionamentos); $i++) {
		$img['tmp_name'] = $i;
		$dados = array(
			$img,//0
			$estacionamentos[$i]['nm_name'],//1
			$estacionamentos[$i]['des_endereco']//2
		);
		$dates = array(
			$estacionamentos[$i]['vl_dia'],
			$estacionamentos[$i]['vl_con'],
			$estacionamentos[$i]['vl_men']
		);
		for ($i2=0;$i2<count($datas);$i2++) { 
			if($datas[$i2]['id_esta']==$i){
				$dates[count($dates)] = array(
				    $datas[$i2]['dt_disp'],//data
				    $datas[$i2]['preco']//preço base
				);
			}
		};
		if($dados[0]['tmp_name'] != ''){
			$cd = CadEsta($dados)->cd_esta;
			CadDate($dates, $cd);
		}
	}
	rename('index.php', 'ig.php');
	rename('Home.php', 'index.php');
	move('index.php');
	
?>
