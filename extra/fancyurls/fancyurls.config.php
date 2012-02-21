<?php
	/*
		このディレクトリについて：
		---------------------------
		
		このディレクトリには、URLから「index.php」の部分を取り除いて、ユーザーフレンドリーなURL表記を実現する
		「fancy urls」に関連するファイルが収められています。
	
		導入：
		-------
		
		1. このディレクトリにおいてある全てのファイルを、Nucleusのindex.php、action.phpが置いてあるディレクトリに
		   コピーします。
		   
		   すでに.htaccessファイルがディレクトリに用意してある時は、元の.htaccessファイルにこのディレクトリにある
		   .htaccessファイルの内容を追記します。(ほとんどのFTPクライアントは、初期状態で.htaccess等のファイルが表
		   されないように設定されているので、各ソフトの設定でこれらのファイルを扱えるようにしなければなりません)

		2. このファイルを編集して、$CONF['Self']に、index.phpのあるディレクトリを指定します。
		   注：このとき、URLの最後に「/(スラッシュ)」をつけないように！！

		3. index.php を次のように編集します。
		   
			$CONF = array();

			include('./fancyurls.config.php'); 
			include('./config.php');

			selector();
			
		4. Nucleusの管理エリアの「グローバル設定」のページで、「Fancy URLs」を有効にします。

		5. 以上！
		
		動かない時は:
		---------------
		
		残念。コピーしたファイルを削除します。(.htaccessファイルも忘れずに)
		
	*/

	
	// 注：このとき、URLの最後に「/(スラッシュ)」をつけないように！！ 
	$CONF['Self'] = 'http://www.yourhost.com/yourpath';

    /*
    	高度な設定：FancyURLのキーワード
    	
    	FancyURLに使用するキーワードを変更することが出来ます。
    	この設定を変更する場合は、拡張し無しファイルのファイル名と、.htaccessファイルに書かれた
		キーワードも忘れずに変更する必要があります。
    */
    $CONF['ItemKey']        = 'item';		// 個別記事にアクセスするキーワード
    $CONF['ArchiveKey']     = 'archive';	// アーカイブにアクセスするキーワード
    $CONF['ArchivesKey']    = 'archives';	// アーカイブ一覧にアクセスするキーワード
    $CONF['MemberKey']      = 'member';		// メンバーページにアクセスするキーワード
    $CONF['BlogKey']        = 'blog';		// ブログ別にアクセスするキーワード
    $CONF['CategoryKey']    = 'category';	// カテゴリ別にアクセスするキーワード
    $CONF['SpecialskinKey'] = 'special';	// スペシャルスキンパーツで作ったページにアクセスするキーワード
?>