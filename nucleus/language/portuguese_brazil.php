<?php

// Portuguese Nucleus Language File
// 
// Author: Rafael Cruz (bataelo@myrealbox.com) (on previous translation by Rodrigo Moraes)
// Nucleus version: v1.0-v2.0
//
// Please note: if you want to translate this file to your own language, be aware
// that in a next Nucleus version, new variables might be added and some other ones
// might be deleted. Therefor, it's important to list the Nucleus version for which 
// the file was written in your document.
//
// Fully translated language file can be sent to Wouter Demuynck (nucleus@demuynck.org)
// and will be available for download (with proper credit to the author, of course)

// START introduced after v2.0 START

// media library
define('_MEDIA_VIEW',				'ver');
define('_MEDIA_VIEW_TT',			'Ver imagem (nova janela)');
define('_MEDIA_FILTER_APPLY',		'Aplicar filtro');
define('_MEDIA_FILTER_LABEL',		'Filtro: ');
define('_MEDIA_UPLOAD_TO',			'Enviar para');
define('_MEDIA_UPLOAD_NEW',			'Nova imagem');
define('_MEDIA_COLLECTION_SELECT',	'Selecionar');
define('_MEDIA_COLLECTION_TT',		'Ir para esta cole��o');
define('_MEDIA_COLLECTION_LABEL',	'Cole��o atual: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Alinhar � esquerda');
define('_ADD_ALIGNRIGHT_TT',		'Alinhar � direita');
define('_ADD_ALIGNCENTER_TT',		'Alinhar ao centro');

// searchable blog setting (yes/no)
define('_EBLOG_SEARCH',				'Incluir na busca');

// generic upload failure
define('_ERROR_UPLOADFAILED',		'Upload failed');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Permitir posts no passado');
define('_ADD_CHANGEDATE',			'Atualizar hor�rio');
define('_BMLET_CHANGEDATE',			'Atualizar hor�rio');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Importar/Exportar skin...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Normal');
define('_PARSER_INCMODE_SKINDIR',	'Usar diret�rio do skin');
define('_SKIN_INCLUDE_MODE',		'Modo de inclus�o');
define('_SKIN_INCLUDE_PREFIX',		'Prefixo de inclus�o');

// global settings
define('_SETTINGS_BASESKIN',		'Skin base');
define('_SETTINGS_SKINSURL',		'URL dos skin');
define('_SETTINGS_ACTIONSURL',		'URL completa para action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Ceategoria default n�o pode ser movida');
define('_ERROR_MOVETOSELF',			'Imposs�vel de mover categoria (destino igual � origem)');
define('_MOVECAT_TITLE',			'Selecione o blog para mover a categoria');
define('_MOVECAT_BTN',				'Mover categoria');

// URLMode setting
define('_SETTINGS_URLMODE',			'Modo da URL');
define('_SETTINGS_URLMODE_NORMAL',	'Normal');
define('_SETTINGS_URLMODE_PATHINFO','Fancy');

// Batch operations
define('_BATCH_NOSELECTION',		'Nenhuma sele��o para executar');
define('_BATCH_ITEMS',				'Opera��o em grupo - �tens');
define('_BATCH_CATEGORIES',			'Opera��o em grupo - categorias');
define('_BATCH_MEMBERS',			'Opera��o em grupo - membros');
define('_BATCH_TEAM',				'Opera��o em grupo - membros do time');
define('_BATCH_COMMENTS',			'Opera��o em grupo - coment�rios');
define('_BATCH_UNKNOWN',			'Opera��o em grupo desconhecida: ');
define('_BATCH_EXECUTING',			'Executando');
define('_BATCH_ONCATEGORY',			'em: categoria');
define('_BATCH_ONITEM',				'em: post');
define('_BATCH_ONCOMMENT',			'em: coment�rio');
define('_BATCH_ONMEMBER',			'em: membro');
define('_BATCH_ONTEAM',				'em: membro de time');
define('_BATCH_SUCCESS',			'Sucesso!');
define('_BATCH_DONE',				'Feito!');
define('_BATCH_DELETE_CONFIRM',		'Confirmar exclus�o em grupo');
define('_BATCH_DELETE_CONFIRM_BTN',	'Confirmar exclus�o em grupo');
define('_BATCH_SELECTALL',			'seleciona tudo');
define('_BATCH_DESELECTALL',		'limpar sele��o');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Apagar');
define('_BATCH_ITEM_MOVE',			'Mover');
define('_BATCH_MEMBER_DELETE',		'Apagar');
define('_BATCH_MEMBER_SET_ADM',		'Dar direitos de administrador');
define('_BATCH_MEMBER_UNSET_ADM',	'Tirar direitos de administrador');
define('_BATCH_TEAM_DELETE',		'Excluir do time');
define('_BATCH_TEAM_SET_ADM',		'Dar direitos de administrador');
define('_BATCH_TEAM_UNSET_ADM',		'Tirar direitos de administrador');
define('_BATCH_CAT_DELETE',			'Apagar');
define('_BATCH_CAT_MOVE',			'Mover para outro blog');
define('_BATCH_COMMENT_DELETE',		'Apagar');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'Novo post');
define('_ADD_PLUGIN_EXTRAS',		'Op��es Extra Plugin');

// errors
define('_ERROR_CATCREATEFAIL',		'Imposs�vel criar nova categoria');
define('_ERROR_NUCLEUSVERSIONREQ',	'Este plugin requer uma vers�o mais nova do nucleus: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Voltar para configura��es do blog');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Importar');
define('_SKINIE_TITLE_EXPORT',		'Exportar');
define('_SKINIE_BTN_IMPORT',		'Importar');
define('_SKINIE_BTN_EXPORT',		'Exportar skins/templates selecionados');
define('_SKINIE_LOCAL',				'Importar de arquivo local:');
define('_SKINIE_NOCANDIDATES',		'Sem candidatos para importar na pasta de skins');
define('_SKINIE_FROMURL',			'Importar da URL:');
define('_SKINIE_EXPORT_INTRO',		'Selecione os skins e templates que voc� quer exportar abaixo');
define('_SKINIE_EXPORT_SKINS',		'Skins');
define('_SKINIE_EXPORT_TEMPLATES',	'Templates');
define('_SKINIE_EXPORT_EXTRA',		'Extra Info');
define('_SKINIE_CONFIRM_OVERWRITE',	'Sobrescrever skins existentes (see nameclashes)');
define('_SKINIE_CONFIRM_IMPORT',	'Sim, quero importar isto');
define('_SKINIE_CONFIRM_TITLE',		'Prestes a importar skins e templates');
define('_SKINIE_INFO_SKINS',		'Skins no arquivo:');
define('_SKINIE_INFO_TEMPLATES',	'Templates no arquivo:');
define('_SKINIE_INFO_GENERAL',		'Info:');
define('_SKINIE_INFO_SKINCLASH',	'Skin com mesmo nome:');
define('_SKINIE_INFO_TEMPLCLASH',	'Template com mesmo nome:');
define('_SKINIE_INFO_IMPORTEDSKINS','Skins importados:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Templates importados:');
define('_SKINIE_DONE',				'Importa��o completa');

define('_AND',						'e');
define('_OR',						'ou');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'campo vazio (clique para editar)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'IncludeMode:');
define('_LIST_SKINS_INCPREFIX',		'IncludePrefix:');
define('_LIST_SKINS_DEFINED',		'Partes definidas:');

// backup
define('_BACKUPS_TITLE',			'Backup / Restore');
define('_BACKUP_TITLE',				'Backup');
define('_BACKUP_INTRO',				'Click the button below to create a backup of your Nucleus database. You\'ll be prompted to save a backup file. Store it in a safe place.');
define('_BACKUP_ZIP_YES',			'Try to use compression');
define('_BACKUP_ZIP_NO',			'Do not use compression');
define('_BACKUP_BTN',				'Create Backup');
define('_BACKUP_NOTE',				'<b>Note:</b> Only the database contents is stored in the backup. Media files and settings in config.php are thus <b>NOT</b> included in the backup.');
define('_RESTORE_TITLE',			'Restore');
define('_RESTORE_NOTE',				'<b>WARNING:</b> Restoring from a backup will <b>ERASE</b> all current Nucleus data in the database! Only do this when you\'re really sure!	<br />	<b>Note:</b> Make sure that the version of Nucleus in which you created the backup should be the same as the version you\'re running right now! It won\'t work otherwise');
define('_RESTORE_INTRO',			'Select the backup file below (it\'ll be uploaded to the server) and click the "Restore" button to start.');
define('_RESTORE_IMSURE',			'Yes, I\'m sure I want to do this!');
define('_RESTORE_BTN',				'Restore From File');
define('_RESTORE_WARNING',			'(make sure you\'re restoring the correct backup, maybe make a new backup before you start)');
define('_ERROR_BACKUP_NOTSURE',		'You\'ll need to check the \'I\'m sure\' testbox');
define('_RESTORE_COMPLETE',			'Restore Complete');

// new item notification
define('_NOTIFY_NI_MSG',			'Um novo post foi postado:');
define('_NOTIFY_NI_TITLE',			'Novo post!');
define('_NOTIFY_KV_MSG',			'Karma vote no post:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Coment�rio no post');
define('_NOTIFY_NC_TITLE',			'Nucleus comment:');
define('_NOTIFY_USERID',			'ID do usu�rio:');
define('_NOTIFY_USER',				'Nome:');
define('_NOTIFY_COMMENT',			'Coment�rio:');
define('_NOTIFY_VOTE',				'Voto:');
define('_NOTIFY_HOST',				'Host:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'Membro:');
define('_NOTIFY_TITLE',				'T�tulo:');
define('_NOTIFY_CONTENTS',			'Conte�do:');

// member mail message
define('_MMAIL_MSG',				'Esta mensagem foi enviada atrav�s do seu blog por ');
define('_MMAIL_FROMANON',			'um visitante an�nimo');
define('_MMAIL_FROMNUC',			'');
define('_MMAIL_TITLE',				'Mensagem de');
define('_MMAIL_MAIL',				'Mensagem:');

// END introduced after v1.5 END

// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'Publicar');
define('_BMLET_EDIT',				'Editar');
define('_BMLET_DELETE',				'Apagar');
define('_BMLET_BODY',				'Texto principal');
define('_BMLET_MORE',				'Leia mais');
define('_BMLET_OPTIONS',			'Op��es');
define('_BMLET_PREVIEW',			'Pr�via');

// used in bookmarklet
define('_ITEM_UPDATED',				'Item editado');
define('_ITEM_DELETED',				'Item apagado');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Tem certeza que quer apagar o plugin');
define('_ERROR_NOSUCHPLUGIN',		'Este plugin n�o existe');
define('_ERROR_DUPPLUGIN',		'Oops. Este plugin j� est� instalado');
define('_ERROR_PLUGFILEERROR',		'Este plugin n�o existe, ou as permiss�es n�o est�o definidas corretamente');
define('_PLUGS_NOCANDIDATES',		'Nenhum plugin encontrado');

define('_PLUGS_TITLE_MANAGE',		'Administra��o de plugins');
define('_PLUGS_TITLE_INSTALLED',	'J� instalados');
define('_PLUGS_TITLE_UPDATE',		'Atualizar lista de inscritos');
define('_PLUGS_TEXT_UPDATE',		'Quando voc� atualiza um plugin susbstiruindo o arquivo, atualize o cache do Nucleus');
define('_PLUGS_TITLE_NEW',			'Instalar novo plugin');
define('_PLUGS_ADD_TEXT',			'Aqui est�o os arquivos localizados no diret�rio de plugins. Alguns podem ser plugins n�o instalados. Certifique-se de colocar apenas arquivos de plugin neste diret�rio.');
define('_PLUGS_BTN_INSTALL',		'Instalar plugin');
define('_BACKTOOVERVIEW',			'Voltar');

// editlink
define('_TEMPLATE_EDITLINK',		'Editar o link do item');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'Caixa � esquerda');
define('_ADD_RIGHT_TT',				'Caixa � direita');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'Nova categoria');

// new settings
define('_SETTINGS_PLUGINURL',		'Endere�o do plugin');
define('_SETTINGS_MAXUPLOADSIZE',	'Tamanho m�ximo dos arquivos (bytes)');
define('_SETTINGS_NONMEMBERMSGS',	'Permitir que n�o membros enviem mensagens');
define('_SETTINGS_PROTECTMEMNAMES',	'Proteger nomes de membros');

// overview screen
define('_OVERVIEW_PLUGINS',			'Administra��o de plugins...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'Novo membro registrado:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'Seu e-mail:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'Voc� n�o possui autoriza��o ou n�o pode enviar arquivos para o diret�rio');

// plugin list
define('_LISTS_INFO',				'Informa��o');
define('_LIST_PLUGS_AUTHOR',		'Author:');
define('_LIST_PLUGS_VER',			'Vers�o:');
define('_LIST_PLUGS_SITE',			'Site:');
define('_LIST_PLUGS_DESC',			'Descri��o:');
define('_LIST_PLUGS_SUBS',			'Inscreva-se:');
define('_LIST_PLUGS_UP',			'para cima');
define('_LIST_PLUGS_DOWN',			'para baixo');
define('_LIST_PLUGS_UNINSTALL',		'desinstalar');
define('_LIST_PLUGS_ADMIN',			'admin');
define('_LIST_PLUGS_OPTIONS',		'editar op��es');

// plugin option list
define('_LISTS_VALUE',				'Valor');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'este plugin n�o tem op��es');
define('_PLUGS_BACK',				'Volta para a lista de plugins');
define('_PLUGS_SAVE',				'Gravar op��es');
define('_PLUGS_OPTIONS_UPDATED',	'Op��es de plugin atualizadas');

define('_OVERVIEW_MANAGEMENT',		'Administra��o');
define('_OVERVIEW_MANAGE',			'Administra��o do Nucleus...');
define('_MANAGE_GENERAL',			'Administra��o geral');
define('_MANAGE_SKINS',				'Skins e Templates');
define('_MANAGE_EXTRA',				'Extras');

define('_BACKTOMANAGE',				'Volta para a Administra��o do Nucleus');


// END introduced after v1.1 END

// charset to use 
define('_CHARSET',					'iso-8859-1');

// global stuff
define('_LOGOUT',					'Sair');
define('_LOGIN',					'Entrar');
define('_YES',						'Sim');
define('_NO',						'N�o');
define('_SUBMIT',					'Envia');
define('_ERROR',					'Erro');
define('_ERRORMSG',					'Occorreu um erro!');
define('_BACK',						'Volta');
define('_NOTLOGGEDIN',				'Voc� n�o est� logado');
define('_LOGGEDINAS',				'Voc� est� logado como');
define('_ADMINHOME',				'In�cio');
define('_NAME',						'Nome');
define('_BACKHOME',					'In�cio');
define('_BADACTION',				'A a��o solicitada n�o existe');
define('_MESSAGE',					'Mensagem');
define('_HELP_TT',					'Ajuda');
define('_YOURSITE',					'p�gina inicial');


define('_POPUP_CLOSE',				'Fecha a janela');

define('_LOGIN_PLEASE',				'Por favor, fa�a o log in');

// commentform
define('_COMMENTFORM_YOUARE',		'Voc� est� logado como');
define('_COMMENTFORM_SUBMIT',		'Envia');
define('_COMMENTFORM_COMMENT',		'Seu coment�rio');
define('_COMMENTFORM_NAME',			'Nome');
define('_COMMENTFORM_MAIL',			'E-mail ou site');
define('_COMMENTFORM_REMEMBER',		'auto-completar na pr�xima visita');

// loginform
define('_LOGINFORM_NAME',			'Nome');
define('_LOGINFORM_PWD',			'Senha');
define('_LOGINFORM_YOUARE',			'Ol�, ');
define('_LOGINFORM_SHARED',			'Desativar login autom�tico');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'Enviar');

// search form
define('_SEARCHFORM_SUBMIT',		'Buscar');

// add item form
define('_ADD_ADDTO',				'Novo post em');
define('_ADD_CREATENEW',			'Novo post');
define('_ADD_BODY',					'Corpo do texto');
define('_ADD_TITLE',				'T�tulo');
define('_ADD_MORE',					'Texto extendido para o "leia mais&raquo;" (opcional)');
define('_ADD_CATEGORY',				'Tema');
define('_ADD_PREVIEW',				'Previs�o');
define('_ADD_DISABLE_COMMENTS',		'Desativar coment�rios');
define('_ADD_DRAFTNFUTURE',			'Rascunhos &amp; itens futuros');
define('_ADD_ADDITEM',				'Novo post');
define('_ADD_ADDNOW',				'Publicar agora');
define('_ADD_ADDLATER',				'Publicar mais tarde');
define('_ADD_PLACE_ON',				'Publicar no dia');
define('_ADD_ADDDRAFT',				'Colocar nos rascunhos');
define('_ADD_NOPASTDATES',			'');
define('_ADD_BOLD_TT',				'Negrito');
define('_ADD_ITALIC_TT',			'It�lico');
define('_ADD_HREF_TT',				'Link');
define('_ADD_MEDIA_TT',				'Imagem');
define('_ADD_PREVIEW_TT',			'Mostrar o preview');
define('_ADD_CUT_TT',				'Cortar');
define('_ADD_COPY_TT',				'Copiar');
define('_ADD_PASTE_TT',				'Colar');


// edit item form
define('_EDIT_ITEM',				'Editar post');
define('_EDIT_SUBMIT',				'Editar post');
define('_EDIT_ORIG_AUTHOR',			'Autor');
define('_EDIT_BACKTODRAFTS',		'Devolver aos rascunhos');
define('_EDIT_COMMENTSNOTE',		'(desativar os coment�rios n�o oculta os j� enviados)');

// used on delete screens
define('_DELETE_CONFIRM',			'Por favor, confirme ');
define('_DELETE_CONFIRM_BTN',		'confirma');
define('_CONFIRMTXT_ITEM',			'Voc� est� prestes a excluir o seguinte post:');
define('_CONFIRMTXT_COMMENT',		'Voc� est� prestes a excluir o seguinte coment�rio:');
define('_CONFIRMTXT_TEAM1',			'Voc� est� prestes a excluir ');
define('_CONFIRMTXT_TEAM2',			' da equipe do blog ');
define('_CONFIRMTXT_BLOG',			'O blog que voc� vai excluir �: ');
define('_WARNINGTXT_BLOGDEL',		'<b>ATEN��O!</b><br />Ao excluir um blog voc� apagar� todas os posts e todos os coment�rios deste blog.<br />Certifique-se do que est� fazendo antes de confirmar esta a��o! <br />');
define('_CONFIRMTXT_MEMBER',		'Voc� est� prestes a excluir o seguinte membro: ');
define('_CONFIRMTXT_TEMPLATE',		'Voc� est� prestes a excluir o template ');
define('_CONFIRMTXT_SKIN',			'Voc� est� prestes a excluir a skin ');
define('_CONFIRMTXT_BAN',			'Voc� est� prestes a cancelar o banimento do IP');
define('_CONFIRMTXT_CATEGORY',		'Voc� est� prestes a excluir o tema ');

// some status messages
define('_DELETED_ITEM',				'Post exclu�do');
define('_DELETED_MEMBER',			'Membro exclu�do');
define('_DELETED_COMMENT',			'Coment�rio exclu�do');
define('_DELETED_BLOG',				'Blog exclu�do');
define('_DELETED_CATEGORY',			'Tema exclu�;do');
define('_ITEM_MOVED',				'Post tranferido');
define('_ITEM_ADDED',				'Post publicado');
define('_COMMENT_UPDATED',			'Coment�rio editado');
define('_SKIN_UPDATED',				'A skin foi salva');
define('_TEMPLATE_UPDATED',			'O template foi salvo');

// errors
define('_ERROR_COMMENT_LONGWORD',	'Por favor, n�o use palavras com mais de 90 caracteres em seus coment�rios');
define('_ERROR_COMMENT_NOCOMMENT',	'Comente');
define('_ERROR_COMMENT_NOUSERNAME',	'Usu�rio desconhecido.');
define('_ERROR_COMMENT_TOOLONG',	'Seu coment�rio � longo demais. Escreva no m�ximo 5000 caracteres.');
define('_ERROR_COMMENTS_DISABLED',	'Coment�rios para este blog est�o desabilitados.');
define('_ERROR_COMMENTS_NONPUBLIC',	'Voc� precisa estar logado como um membro para comentar este blog');
define('_ERROR_COMMENTS_MEMBERNICK','Voc� tentou assinar o coment�rio com um nome protegido. Esta assinatura s� pode ser utilizada pelo usu�rio que a cadastrou.<br /><br />Por favor, volte � p�gina anterior e tente novamente.');
define('_ERROR_SKIN',				'Erro de skin');
define('_ERROR_ITEMCLOSED',			'Este post n�o permite coment�rios');
define('_ERROR_NOSUCHITEM',			'Este post n�o existe.');
define('_ERROR_NOSUCHBLOG',			'Este blog n�o existe.');
define('_ERROR_NOSUCHSKIN',			'Esta skin n�o existe.');
define('_ERROR_NOSUCHMEMBER',		'Este membro n�o existe.');
define('_ERROR_NOTONTEAM',			'Voc� n�o pertence � equipe deste blog.');
define('_ERROR_BADDESTBLOG',		'O blog escolhido n�o existe.');
define('_ERROR_NOTONDESTTEAM',		'N�o � poss�vel mover o post: voc� n�o pertence � equipe do blog de destino.');
define('_ERROR_NOEMPTYITEMS',		'N�o � posss�vel adicionar posts sem texto!');
define('_ERROR_BADMAILADDRESS',		'Endere�o de e-mail inv�lido');
define('_ERROR_BADNOTIFY',			'Um ou mais e-mails n�o s�o v�lidos');
define('_ERROR_BADNAME',			'O nome � inv�lido. Use apenas letras e n�meros, sem acentos e nem espa�os no in�cio ou no fim.');
define('_ERROR_NICKNAMEINUSE',		'J� existe um usu�rio com este apelido. Tente outro.');
define('_ERROR_PASSWORDMISMATCH',	'As senhas devem ser id�nticas');
define('_ERROR_PASSWORDTOOSHORT',	'A senha precisa ter no m�nimo 6 caracteres');
define('_ERROR_PASSWORDMISSING',	'Voc� n�o digitou uma senha');
define('_ERROR_REALNAMEMISSING',	'Voc� n�o digitou um nome real');
define('_ERROR_ATLEASTONEADMIN',	'� necess�rio pelo menos um super-admin que possa logar na �rea dministrativa.');
define('_ERROR_ATLEASTONEBLOGADMIN','Certifique-se de que h� pelo menos um administrador.');
define('_ERROR_ALREADYONTEAM',		'Voc� n�o pode adicionar um membro que j� pertence � equipe');
define('_ERROR_BADSHORTBLOGNAME',	'O nome resumido s&oacute pode conter a-z e 0-9, sem espa�oss');
define('_ERROR_DUPSHORTBLOGNAME',	'Outro blog j� usa este nome resumido. Escolha outro');
define('_ERROR_UPDATEFILE',			'N�o h� acesso para atualizar o arquivo. Certifique-se de que as permiss�es est�o configuradas corretamente (experimente colocar o chmod em 666). Perceba que a localiza��o � relativa � �rea administrativa, por isso voc� pode querer usar o diret&oacuterio absoluto (algo como  /seu/diret&oacuterio/do/nucleus/)');
define('_ERROR_DELDEFBLOG',			'N�o � poss�vel excluir o blog padr�o');
define('_ERROR_DELETEMEMBER',		'este membro n�o pode ser exclu�do, provavelmente porque ele � autor de posts ou coment�rios');
define('_ERROR_BADTEMPLATENAME',	'Nome de template inv�lido. Use apenas a-z e 0-9, sem espa�os');
define('_ERROR_DUPTEMPLATENAME',	'J� existe um template com este nome');
define('_ERROR_BADSKINNAME',		'Nome de skin inv�lido. Use apenas a-z e 0-9, sem espa�os');
define('_ERROR_DUPSKINNAME',		'J� existe uma skin com este nome');
define('_ERROR_DEFAULTSKIN',		'Sempre deve haver uma skin com o nome "default"');
define('_ERROR_SKINDEFDELETE',		'N�o � poss�vel excluir esta skin porque ela � usada pelo segunte blog: ');
define('_ERROR_DISALLOWED',			'Voc� n�o est� autorizado a fazer isso');
define('_ERROR_DELETEBAN',			'Erro ao tentar excluir o banimento (o ban n�o existe)');
define('_ERROR_ADDBAN',				'Erro ao tentar adiconar um banimento. O IP banido pode n�o ter sido corretamente adicionado aos seus blogs.');
define('_ERROR_BADACTION',			'Esta a��o n�o existe');
define('_ERROR_MEMBERMAILDISABLED',	'E-mail membro a membro est� desabilitado');
define('_ERROR_MEMBERCREATEDISABLED','Cria��o de contas est� desabilitada');
define('_ERROR_INCORRECTEMAIL',		'E-mail incorreto');
define('_ERROR_VOTEDBEFORE',		'Voc� j� votou neste post');
define('_ERROR_BANNED1',			'N�o � poss�vel executar a a��o porque o seu IP (');
define('_ERROR_BANNED2',			') est� banido. A raz�o para isso �: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'Voc� precisa estar logado para executar esta a��o');
define('_ERROR_CONNECT',			'Erro de conex�o');
define('_ERROR_FILE_TOO_BIG',		'Arquivo grande demais!');
define('_ERROR_BADFILETYPE',		'Este tipo de arquivo n�o � permitido');
define('_ERROR_BADREQUEST',			'Ocorreu um problema no envio do arquivo');
define('_ERROR_DISALLOWEDUPLOAD',	'Voc� n�o pertence a nenhuma equipe de blog e por isso n�o pode enviar arquivos');
define('_ERROR_BADPERMISSIONS',		'Permiss�o de diret&oacuterio n�o est�o configuradas corretamente');
define('_ERROR_UPLOADMOVEP',		'Ocorreu um problema ao enviar o arquivo');
define('_ERROR_UPLOADCOPY',			'Ocorreu um problema ao copiar o arquivo');
define('_ERROR_UPLOADDUPLICATE',	'J� existe um arquivo com este nome. Renomeie antes de enviar.');
define('_ERROR_LOGINDISALLOWED',	'Voc� n�o pode logar. Tente usar outro usu�rio.');
define('_ERROR_DBCONNECT',			'N�o foi poss�vel conectar com o servidor mySQL.');
define('_ERROR_DBSELECT',			'N�o foi posss�vel acessar o banco de dados nucleus.');
define('_ERROR_NOSUCHLANGUAGE', 'Esta l�ngua n�o existe');
define('_ERROR_NOSUCHCATEGORY', 'Este tema n�o existe');
define('_ERROR_DELETELASTCATEGORY', '� preciso haver ao menos um tema');
define('_ERROR_DELETEDEFCATEGORY', 'Voc� n�o pode apagar o tema');
define('_ERROR_BADCATEGORYNAME', 'Este nome n�o pode ser usado para um tema');
define('_ERROR_DUPCATEGORYNAME', 'J� existe um tema com este nome');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Aviso: este n�o � um diret&oacuterio v�lido!');
define('_WARNING_NOTREADABLE',		'Aviso: este diret&oacuterio n�o pode ser lido!');
define('_WARNING_NOTWRITABLE',		'Aviso: este diret&oacuterio n�o tem permiss�o de escrita!');

// media and upload
define('_MEDIA_UPLOADLINK',			'Enviar um novo arquivo');
define('_MEDIA_MODIFIED',			'modificado');
define('_MEDIA_FILENAME',			'arquivo');
define('_MEDIA_DIMENSIONS',			'dimens�es');
define('_MEDIA_INLINE',				'Na p�gina');
define('_MEDIA_POPUP',				'Em janela popup');
define('_UPLOAD_TITLE',				'Escolha o arquivo');
define('_UPLOAD_MSG',				'Escolha o arquivo que voc� deseja enviar e clique no bot�o "Envia".');
define('_UPLOAD_BUTTON',			'Enviar');

// some status messages
define('_MSG_ACCOUNTCREATED',		'Conta criada. A senha ser� enviada por e-mail.');
define('_MSG_PASSWORDSENT',			'A senha foi enviada por e-mail.');
define('_MSG_LOGINAGAIN',			'Voc� precisa logar de novo, porque suas indforma��es foram alteradas');
define('_MSG_SETTINGSCHANGED',		'Configura��es alteradas');
define('_MSG_ADMINCHANGED',			'Administrador alterado');
define('_MSG_NEWBLOG',				'Novo blog criado');
define('_MSG_ACTIONLOGCLEARED',		'O log foi limpo');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'A��o n�o permitida: ');
define('_ACTIONLOG_PWDREMINDERSENT','A nova senha foi enviada para ');
define('_ACTIONLOG_TITLE',			'Arquivo de log');
define('_ACTIONLOG_CLEAR_TITLE',	'Limpa o log');
define('_ACTIONLOG_CLEAR_TEXT',		'Limpa o log agora');

// team management
define('_TEAM_TITLE',				'Equipe do blog ');
define('_TEAM_CURRENT',				'Equipe atual');
define('_TEAM_ADDNEW',				'Novo membro');
define('_TEAM_CHOOSEMEMBER',		'Escolha o membro');
define('_TEAM_ADMIN',				'Privil�gios de administrador? ');
define('_TEAM_ADD',					'Adicionar � equipe');
define('_TEAM_ADD_BTN',				'Adicionar � equipe');

// blogsettings
define('_EBLOG_TITLE',				'Configura��es do blog');
define('_EBLOG_TEAM_TITLE',			'Alterar equipe');
define('_EBLOG_TEAM_TEXT',			'Clique aqui para alterar a equipe deste blog.');
define('_EBLOG_SETTINGS_TITLE',		'Configura��es do blog');
define('_EBLOG_NAME',				'Nome');
define('_EBLOG_SHORTNAME',			'Nome resumido');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(use apenas a-z e 0-9, sem espa�os)');
define('_EBLOG_DESC',				'Descri��o');
define('_EBLOG_URL',				'Endere�o (http://...)');
define('_EBLOG_DEFSKIN',			'Skin padr�o');
define('_EBLOG_DEFCAT',				'Categoria padr�o');
define('_EBLOG_LINEBREAKS',			'Converter quebras de linhas?');
define('_EBLOG_DISABLECOMMENTS',	'Habilitar coment�rios?');
define('_EBLOG_ANONYMOUS',			'Permitir coment�rios de n�o-membros?');
define('_EBLOG_NOTIFY',				'Avisar e-mails (use ; para separar)');
define('_EBLOG_NOTIFY_ON',			'Aviso ligado para');
define('_EBLOG_NOTIFY_COMMENT',		'Novos coment�rios');
define('_EBLOG_NOTIFY_KARMA',		'Novos votos de karma');
define('_EBLOG_NOTIFY_ITEM',		'Novos posts no blog');
define('_EBLOG_PING',				'Dar ping no Weblogs.com?');
define('_EBLOG_MAXCOMMENTS',		'N�mero m�ximo de coment�rios');
define('_EBLOG_UPDATE',				'Atualiza arquivo');
define('_EBLOG_OFFSET',				'Diferen�a de fuso');
define('_EBLOG_STIME',				'A hora atual no servidor �');
define('_EBLOG_BTIME',				'A hora atual no blog �');
define('_EBLOG_CHANGE',				'Salvar altera��es');
define('_EBLOG_CHANGE_BTN',			'Salvar altera��es');
define('_EBLOG_ADMIN',				'Administrador do blog');
define('_EBLOG_ADMIN_MSG',			'Voc� ter� privil�gios de administrador');
define('_EBLOG_CREATE_TITLE',		'Criar novo blog');
define('_EBLOG_CREATE_TEXT',		'Preencha os campos abaixo para criar um novo blog. <br /><br /> <b>Nota:</b> Apenas os campos necess�rios est�o listados. Se voc� quer configurar op��es extras, acesse as configura��es do blog depois de cri�-lo.');
define('_EBLOG_CREATE',				'Cria o blog!');
define('_EBLOG_CREATE_BTN',			'Cria um novo blog');
define('_EBLOG_CAT_TITLE',			'Categorias');
define('_EBLOG_CAT_NAME',			'Nome da categoria');
define('_EBLOG_CAT_DESC',			'Descri��o da categoria');
define('_EBLOG_CAT_CREATE',			'Criar nova categoria');
define('_EBLOG_CAT_UPDATE',			'Alterar cateforia');
define('_EBLOG_CAT_UPDATE_BTN',		'Alterar categoria');

// templates
define('_TEMPLATE_TITLE',			'Edita templates');
define('_TEMPLATE_AVAILABLE_TITLE',	'Templates dispon�veis');
define('_TEMPLATE_NEW_TITLE',		'Novo template');
define('_TEMPLATE_NAME',			'Nome do template');
define('_TEMPLATE_DESC',			'Descri��o do template');
define('_TEMPLATE_CREATE',			'Cria template');
define('_TEMPLATE_CREATE_BTN',		'Cria template');
define('_TEMPLATE_EDIT_TITLE',		'Edita template');
define('_TEMPLATE_BACK',			'Volta para a lista de templates');
define('_TEMPLATE_EDIT_MSG',		'Nem todas as partes do template s�o necess�rias. Deixe em branco as que n�o for utilizar.');
define('_TEMPLATE_SETTINGS',		'Configura��es do template');
define('_TEMPLATE_ITEMS',			'Posts');
define('_TEMPLATE_ITEMHEADER',		'Cabe�alhos dos posts');
define('_TEMPLATE_ITEMBODY',		'Corpo dos posts');
define('_TEMPLATE_ITEMFOOTER',		'Fim dos posts');
define('_TEMPLATE_MORELINK',		'Link para o texto extendido');
define('_TEMPLATE_NEW',				'Indica��o de novo post');
define('_TEMPLATE_COMMENTS_ANY',	'Coment�rios (se houver)');
define('_TEMPLATE_CHEADER',			'Cabe�alho dos coment�rios');
define('_TEMPLATE_CBODY',			'Corpo dos coment�rios');
define('_TEMPLATE_CFOOTER',			'Fim dos coment�rios');
define('_TEMPLATE_CONE',			'Um coment�rio');
define('_TEMPLATE_CMANY',			'Dois ou mais coment�rios');
define('_TEMPLATE_CMORE',			'Leia mais nos coment�rios');
define('_TEMPLATE_CMEXTRA',			'Extras dos membros');
define('_TEMPLATE_COMMENTS_NONE',	'Coment�rios (se n�o tiver nenhum)');
define('_TEMPLATE_CNONE',			'Nenhum coment�rio');
define('_TEMPLATE_COMMENTS_TOOMUCH','Coment�rios (se houver, mas longos demais para serem mostrados)');
define('_TEMPLATE_CTOOMUCH',		'Coment�rios demais');
define('_TEMPLATE_ARCHIVELIST',		'Listagem de arquivo');
define('_TEMPLATE_AHEADER',			'Cabe�alho do arquivo');
define('_TEMPLATE_AITEM',			'Lista de posts no arquivo');
define('_TEMPLATE_AFOOTER',			'Fim do arquivo');
define('_TEMPLATE_DATETIME',		'Data e hora');
define('_TEMPLATE_DHEADER',			'Cabe�alho da data');
define('_TEMPLATE_DFOOTER',			'Fim da data');
define('_TEMPLATE_DFORMAT',			'Formato da data');
define('_TEMPLATE_TFORMAT',			'Formato da hora');
define('_TEMPLATE_LOCALE',			'Locale');
define('_TEMPLATE_IMAGE',			'Janelas popup para imagens');
define('_TEMPLATE_PCODE',			'C�digo das janelas popup');
define('_TEMPLATE_ICODE',			'C�digo das imagens na p�gina');
define('_TEMPLATE_MCODE',			'C�digo de link para outras m�dias');
define('_TEMPLATE_SEARCH',			'Busca');
define('_TEMPLATE_SHIGHLIGHT',		'Sublinhado');
define('_TEMPLATE_SNOTFOUND',		'Nada encontrado na busca');
define('_TEMPLATE_UPDATE',			'Atualiza');
define('_TEMPLATE_UPDATE_BTN',		'Altera template');
define('_TEMPLATE_RESET_BTN',		'Limpa');
define('_TEMPLATE_CATEGORYLIST',	'Listas de temas');
define('_TEMPLATE_CATHEADER',		'Cabe�alho da lista de temas');
define('_TEMPLATE_CATITEM',			'Item da lista de temas');
define('_TEMPLATE_CATFOOTER',		'Fim da lista de temas');

// skins
define('_SKIN_EDIT_TITLE',			'Edita skins');
define('_SKIN_AVAILABLE_TITLE',		'Skins dispon�veis');
define('_SKIN_NEW_TITLE',			'Nova skin');
define('_SKIN_NAME',				'Nome');
define('_SKIN_DESC',				'Descri��o');
define('_SKIN_TYPE',				'Tipo de conte�do');
define('_SKIN_CREATE',				'Cria');
define('_SKIN_CREATE_BTN',			'Cria skin');
define('_SKIN_EDITONE_TITLE',		'Edita skin');
define('_SKIN_BACK',				'Volta para a lista de skins');
define('_SKIN_PARTS_TITLE',			'Partes da skin');
define('_SKIN_PARTS_MSG',			'Nem todas as partes da skin s�o necess�rias. Deixe em branco as que n�o for utilizar.');
define('_SKIN_PART_MAIN',			'P�gina inicial');
define('_SKIN_PART_ITEM',			'Posts individuais');
define('_SKIN_PART_ALIST',			'Lista de arquivos');
define('_SKIN_PART_ARCHIVE',		'Arquivo');
define('_SKIN_PART_SEARCH',			'Busca');
define('_SKIN_PART_ERROR',			'Erro');
define('_SKIN_PART_MEMBER',			'Detalhes dos membros');
define('_SKIN_PART_POPUP',			'Janelas popups de imagem');
define('_SKIN_GENSETTINGS_TITLE',	'Configura��es gerais');
define('_SKIN_CHANGE',				'Altera');
define('_SKIN_CHANGE_BTN',			'Altera configura��es');
define('_SKIN_UPDATE_BTN',			'Atualiza skin');
define('_SKIN_RESET_BTN',			'Limpa');
define('_SKIN_EDITPART_TITLE',		'Edita skin');
define('_SKIN_GOBACK',				'Volta');
define('_SKIN_ALLOWEDVARS',			'Vari�veis dispon�veis (clique para mais informa��es):');

// global settings
define('_SETTINGS_TITLE',			'Configura��es gerais');
define('_SETTINGS_SUB_GENERAL',		'Configura��es gerais');
define('_SETTINGS_DEFBLOG',			'Blog padr�o');
define('_SETTINGS_ADMINMAIL',		'E-mail do adminstrador');
define('_SETTINGS_SITENAME',		'Nome do site');
define('_SETTINGS_SITEURL',			'Endere�o do site (deve terminar com uma barra)');
define('_SETTINGS_ADMINURL',		'Endere�o da �rea administrativa (deve terminar com uma barra)');
define('_SETTINGS_DIRS',			'Diret�rios do Nucleus');
define('_SETTINGS_MEDIADIR',		'Diret�rio da m�dia');
define('_SETTINGS_SEECONFIGPHP',	'(veja config.php)');
define('_SETTINGS_MEDIAURL',		'Endere�o da m�dia (deve terminar com uma barra)');
define('_SETTINGS_ALLOWUPLOAD',		'Permite envio de arquivos?');
define('_SETTINGS_ALLOWUPLOADTYPES','Tipos de arquivos permitidos para envio');
define('_SETTINGS_CHANGELOGIN',		'Permite que membros alterem Login/Senha');
define('_SETTINGS_COOKIES_TITLE',	'Configura��es do cookie');
define('_SETTINGS_COOKIELIFE',		'Cookie por tempo de expira��o');
define('_SETTINGS_COOKIESESSION',	'Cookie por sess�o');
define('_SETTINGS_COOKIEMONTH',		'Expira��o de um m�s');
define('_SETTINGS_COOKIEPATH',		'Local do cookie (avan�ado)');
define('_SETTINGS_COOKIEDOMAIN',	'Dom�nio do cookie (avan�ado)');
define('_SETTINGS_COOKIESECURE',	'Cookie seguro (avan�ado)');
define('_SETTINGS_LASTVISIT',		'Gravar cookies das &uacuteltimas visitas');
define('_SETTINGS_ALLOWCREATE',		'Permitir que usu�rios criem novas contas');
define('_SETTINGS_NEWLOGIN',		'Permitir login para as contas criadas por usu�rios');
define('_SETTINGS_NEWLOGIN2',		'(apenas para as novas contas criadas)');
define('_SETTINGS_MEMBERMSGS',		'Permitir servi�o membro-a-membro');
define('_SETTINGS_LANGUAGE',		'Linguagem padr�o');
define('_SETTINGS_DISABLESITE',		'Desabilitar o site');
define('_SETTINGS_DBLOGIN',			'Login do banco de dados mySQL');
define('_SETTINGS_UPDATE',			'Atualiza configura��es');
define('_SETTINGS_UPDATE_BTN',		'Atualiza configura��es');
define('_SETTINGS_DISABLEJS',		'Desabilitar barra de ferramentas em javaScript');
define('_SETTINGS_MEDIA',			'Configura��es do envio de arquivos');
define('_SETTINGS_MEDIAPREFIX',		'Colocar data no prefixo dos arquivos enviados');
define('_SETTINGS_MEMBERS',			'Configura��es dos membros');

// bans
define('_BAN_TITLE',				'Lista de IPs banidos do blog');
define('_BAN_NONE',					'Nenhum IP foi banido para este blog');
define('_BAN_NEW_TITLE',			'Banir novo IP');
define('_BAN_NEW_TEXT',				'Banir novo IP');
define('_BAN_REMOVE_TITLE',			'Remover IP banido');
define('_BAN_IPRANGE',				'IP');
define('_BAN_BLOGS',				'Que blogs?');
define('_BAN_DELETE_TITLE',			'Exclui IP banido');
define('_BAN_ALLBLOGS',				'Todos os blogs que voc� tem privil�gios de administrador.');
define('_BAN_REMOVED_TITLE',		'O IP banido foi removido');
define('_BAN_REMOVED_TEXT',			'O IP banido foi removido dos seguintes blogs:');
define('_BAN_ADD_TITLE',			'Banir novo IP');
define('_BAN_IPRANGE_TEXT',			'Escolha o raio de a��o do IP banido. Quanto menos n&uacutemeros, mais endere�os ser�o bloqueados.');
define('_BAN_BLOGS_TEXT',			'Voc� pode banir o IP de apenas um blog ou bloquear o IP de todos os blogs que voc� possui privil�gios de administrador. Escolha abaixo.');
define('_BAN_REASON_TITLE',			'Raz�o');
define('_BAN_REASON_TEXT',			'Voc� pode colocar uma raz�o para o banimento, que ser� mostrada se o IP tentar adicionar um coment�rio. Use no m�ximo 256 caracteres.');
define('_BAN_ADD_BTN',				'Banir novo IP');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Mensagem');
define('_LOGIN_NAME',				'Nome');
define('_LOGIN_PASSWORD',			'Senha');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'Esqueceu sua senha?');

// membermanagement
define('_MEMBERS_TITLE',			'Administra��o de membros');
define('_MEMBERS_CURRENT',			'Membros');
define('_MEMBERS_NEW',				'Novo membro');
define('_MEMBERS_DISPLAY',			'Apelido');
define('_MEMBERS_DISPLAY_INFO',		'(Este � o nome que voc� usa para logar)');
define('_MEMBERS_REALNAME',			'Nome real');
define('_MEMBERS_PWD',				'Senha');
define('_MEMBERS_REPPWD',			'Repita a senha');
define('_MEMBERS_EMAIL',			'E-mail');
define('_MEMBERS_EMAIL_EDIT',		'(quando voc� altera o e-mail, uma nova senha � enviada para o novo endere�o automaticamente)');
define('_MEMBERS_URL',				'Endere�o do blog');
define('_MEMBERS_SUPERADMIN',		'Privil�gios de administrador');
define('_MEMBERS_CANLOGIN',			'Pode logar na �rea administrativa');
define('_MEMBERS_NOTES',			'Notas');
define('_MEMBERS_NEW_BTN',			'Novo membro');
define('_MEMBERS_EDIT',				'Perfil');
define('_MEMBERS_EDIT_BTN',			'Salvar altera��es');
define('_MEMBERS_BACKTOOVERVIEW',	'Voltar para a lista de membros');
define('_MEMBERS_DEFLANG',			'L�ngua');
define('_MEMBERS_USESITELANG',		'- configura��es do site -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'Visitar');
define('_BLOGLIST_ADD',				'Novo post');
define('_BLOGLIST_TT_ADD',			'Novo post para este blog');
define('_BLOGLIST_EDIT',			'Editar posts');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Atalho');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'Configura��es');
define('_BLOGLIST_TT_SETTINGS',		'Edita configura��es ou administra time');
define('_BLOGLIST_BANS',			'Banidos');
define('_BLOGLIST_TT_BANS',			'V�, adicona ou remove IPs banidos');
define('_BLOGLIST_DELETE',			'Excluir este blog');
define('_BLOGLIST_TT_DELETE',		'Exclui este blog');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'Seus blogs');
define('_OVERVIEW_YRDRAFTS',		'Seus rascunhos');
define('_OVERVIEW_YRSETTINGS',		'Configura��es');
define('_OVERVIEW_GSETTINGS',		'Configura��es gerais');
define('_OVERVIEW_NOBLOGS',			'Voc� n�o pertence a nenhuma equipe');
define('_OVERVIEW_NODRAFTS',		'Nenhum rascunho');
define('_OVERVIEW_EDITSETTINGS',	'Alterar seu perfil...');
define('_OVERVIEW_BROWSEITEMS',		'Explora os posts...');
define('_OVERVIEW_BROWSECOMM',		'Explora seus coment�rios...');
define('_OVERVIEW_VIEWLOG',			'Ver Log...');
define('_OVERVIEW_MEMBERS',			'Altera membros...');
define('_OVERVIEW_NEWLOG',			'Cria novo blog...');
define('_OVERVIEW_SETTINGS',		'Edita configura��es...');
define('_OVERVIEW_TEMPLATES',		'Edita templates...');
define('_OVERVIEW_SKINS',			'Edita skins...');
define('_OVERVIEW_BACKUP',			'Faz backup/restaura o banco de dados...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Posts do blog'); 
define('_ITEMLIST_YOUR',			'Seus posts');

// Comments
define('_COMMENTS',					'Coment�rios');
define('_NOCOMMENTS',				'Nenhum coment�rio para este post');
define('_COMMENTS_YOUR',			'Seus coment�rios');
define('_NOCOMMENTS_YOUR',			'Voc� n�o escreveu nenhum coment�rio');

// LISTS (general)
define('_LISTS_NOMORE',				'Nenhum post encontrado');
define('_LISTS_PREV',				'Anterior');
define('_LISTS_NEXT',				'Pr�xima');
define('_LISTS_SEARCH',				'Busca');
define('_LISTS_CHANGE',				'Altera');
define('_LISTS_PERPAGE',			'posts por p�gina');
define('_LISTS_ACTIONS',			'A��es');
define('_LISTS_DELETE',				'Exclui');
define('_LISTS_EDIT',				'Edita');
define('_LISTS_MOVE',				'Move');
define('_LISTS_CLONE',				'Duplica');
define('_LISTS_TITLE',				'T�tulo');
define('_LISTS_BLOG',				'Blog');
define('_LISTS_NAME',				'Nome');
define('_LISTS_DESC',				'Descri��o');
define('_LISTS_TIME',				'Time');
define('_LISTS_COMMENTS',			'Coment�rios');
define('_LISTS_TYPE',				'Tipo');


// member list 
define('_LIST_MEMBER_NAME',			'Apelido');
define('_LIST_MEMBER_RNAME',		'Nome real');
define('_LIST_MEMBER_ADMIN',		'Super-admin? ');
define('_LIST_MEMBER_LOGIN',		'Pode logar? ');
define('_LIST_MEMBER_URL',			'Site');

// banlist
define('_LIST_BAN_IPRANGE',			'IP Banido');
define('_LIST_BAN_REASON',			'Raz�o');

// actionlist
define('_LIST_ACTION_MSG',			'Mensagem');

// commentlist
define('_LIST_COMMENT_BANIP',		'Bane IP');
define('_LIST_COMMENT_WHO',			'Autor');
define('_LIST_COMMENT',				'Coment�rio');
define('_LIST_COMMENT_HOST',		'IP');

// itemlist
define('_LIST_ITEM_INFO',			'Info');
define('_LIST_ITEM_CONTENT',		'T�tulo e texto do post');


// teamlist
define('_LIST_TEAM_ADMIN',			'Administrador ');
define('_LIST_TEAM_CHADMIN',		'Altera Administrador');

// edit comments
define('_EDITC_TITLE',				'Alterar coment�rios');
define('_EDITC_WHO',				'Autor');
define('_EDITC_HOST',				'De onde?');
define('_EDITC_WHEN',				'Quando?');
define('_EDITC_TEXT',				'Texto');
define('_EDITC_EDIT',				'Edita coment�rio');
define('_EDITC_MEMBER',				'membro');
define('_EDITC_NONMEMBER',			'n�o membro');

// move item
define('_MOVE_TITLE',				'Mover o post para qual blog?');
define('_MOVE_BTN',					'Mover');

?>