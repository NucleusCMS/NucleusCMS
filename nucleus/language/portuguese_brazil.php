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
define('_MEDIA_COLLECTION_TT',		'Ir para esta coleção');
define('_MEDIA_COLLECTION_LABEL',	'Coleção atual: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Alinhar à esquerda');
define('_ADD_ALIGNRIGHT_TT',		'Alinhar à direita');
define('_ADD_ALIGNCENTER_TT',		'Alinhar ao centro');

// searchable blog setting (yes/no)
define('_EBLOG_SEARCH',				'Incluir na busca');

// generic upload failure
define('_ERROR_UPLOADFAILED',		'Upload failed');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Permitir posts no passado');
define('_ADD_CHANGEDATE',			'Atualizar horário');
define('_BMLET_CHANGEDATE',			'Atualizar horário');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Importar/Exportar skin...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Normal');
define('_PARSER_INCMODE_SKINDIR',	'Usar diretório do skin');
define('_SKIN_INCLUDE_MODE',		'Modo de inclusão');
define('_SKIN_INCLUDE_PREFIX',		'Prefixo de inclusão');

// global settings
define('_SETTINGS_BASESKIN',		'Skin base');
define('_SETTINGS_SKINSURL',		'URL dos skin');
define('_SETTINGS_ACTIONSURL',		'URL completa para action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Ceategoria default não pode ser movida');
define('_ERROR_MOVETOSELF',			'Impossível de mover categoria (destino igual à origem)');
define('_MOVECAT_TITLE',			'Selecione o blog para mover a categoria');
define('_MOVECAT_BTN',				'Mover categoria');

// URLMode setting
define('_SETTINGS_URLMODE',			'Modo da URL');
define('_SETTINGS_URLMODE_NORMAL',	'Normal');
define('_SETTINGS_URLMODE_PATHINFO','Fancy');

// Batch operations
define('_BATCH_NOSELECTION',		'Nenhuma seleção para executar');
define('_BATCH_ITEMS',				'Operação em grupo - ítens');
define('_BATCH_CATEGORIES',			'Operação em grupo - categorias');
define('_BATCH_MEMBERS',			'Operação em grupo - membros');
define('_BATCH_TEAM',				'Operação em grupo - membros do time');
define('_BATCH_COMMENTS',			'Operação em grupo - comentários');
define('_BATCH_UNKNOWN',			'Operação em grupo desconhecida: ');
define('_BATCH_EXECUTING',			'Executando');
define('_BATCH_ONCATEGORY',			'em: categoria');
define('_BATCH_ONITEM',				'em: post');
define('_BATCH_ONCOMMENT',			'em: comentário');
define('_BATCH_ONMEMBER',			'em: membro');
define('_BATCH_ONTEAM',				'em: membro de time');
define('_BATCH_SUCCESS',			'Sucesso!');
define('_BATCH_DONE',				'Feito!');
define('_BATCH_DELETE_CONFIRM',		'Confirmar exclusão em grupo');
define('_BATCH_DELETE_CONFIRM_BTN',	'Confirmar exclusão em grupo');
define('_BATCH_SELECTALL',			'seleciona tudo');
define('_BATCH_DESELECTALL',		'limpar seleção');

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
define('_ADD_PLUGIN_EXTRAS',		'Opções Extra Plugin');

// errors
define('_ERROR_CATCREATEFAIL',		'Impossível criar nova categoria');
define('_ERROR_NUCLEUSVERSIONREQ',	'Este plugin requer uma versão mais nova do nucleus: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Voltar para configurações do blog');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Importar');
define('_SKINIE_TITLE_EXPORT',		'Exportar');
define('_SKINIE_BTN_IMPORT',		'Importar');
define('_SKINIE_BTN_EXPORT',		'Exportar skins/templates selecionados');
define('_SKINIE_LOCAL',				'Importar de arquivo local:');
define('_SKINIE_NOCANDIDATES',		'Sem candidatos para importar na pasta de skins');
define('_SKINIE_FROMURL',			'Importar da URL:');
define('_SKINIE_EXPORT_INTRO',		'Selecione os skins e templates que você quer exportar abaixo');
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
define('_SKINIE_DONE',				'Importação completa');

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
define('_NOTIFY_NC_MSG',			'Comentário no post');
define('_NOTIFY_NC_TITLE',			'Nucleus comment:');
define('_NOTIFY_USERID',			'ID do usuário:');
define('_NOTIFY_USER',				'Nome:');
define('_NOTIFY_COMMENT',			'Comentário:');
define('_NOTIFY_VOTE',				'Voto:');
define('_NOTIFY_HOST',				'Host:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'Membro:');
define('_NOTIFY_TITLE',				'Título:');
define('_NOTIFY_CONTENTS',			'Conteúdo:');

// member mail message
define('_MMAIL_MSG',				'Esta mensagem foi enviada através do seu blog por ');
define('_MMAIL_FROMANON',			'um visitante anônimo');
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
define('_BMLET_OPTIONS',			'Opções');
define('_BMLET_PREVIEW',			'Prévia');

// used in bookmarklet
define('_ITEM_UPDATED',				'Item editado');
define('_ITEM_DELETED',				'Item apagado');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Tem certeza que quer apagar o plugin');
define('_ERROR_NOSUCHPLUGIN',		'Este plugin não existe');
define('_ERROR_DUPPLUGIN',		'Oops. Este plugin já está instalado');
define('_ERROR_PLUGFILEERROR',		'Este plugin não existe, ou as permissões não estão definidas corretamente');
define('_PLUGS_NOCANDIDATES',		'Nenhum plugin encontrado');

define('_PLUGS_TITLE_MANAGE',		'Administração de plugins');
define('_PLUGS_TITLE_INSTALLED',	'Já instalados');
define('_PLUGS_TITLE_UPDATE',		'Atualizar lista de inscritos');
define('_PLUGS_TEXT_UPDATE',		'Quando você atualiza um plugin susbstiruindo o arquivo, atualize o cache do Nucleus');
define('_PLUGS_TITLE_NEW',			'Instalar novo plugin');
define('_PLUGS_ADD_TEXT',			'Aqui estão os arquivos localizados no diretório de plugins. Alguns podem ser plugins não instalados. Certifique-se de colocar apenas arquivos de plugin neste diretório.');
define('_PLUGS_BTN_INSTALL',		'Instalar plugin');
define('_BACKTOOVERVIEW',			'Voltar');

// editlink
define('_TEMPLATE_EDITLINK',		'Editar o link do item');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'Caixa à esquerda');
define('_ADD_RIGHT_TT',				'Caixa à direita');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'Nova categoria');

// new settings
define('_SETTINGS_PLUGINURL',		'Endereço do plugin');
define('_SETTINGS_MAXUPLOADSIZE',	'Tamanho máximo dos arquivos (bytes)');
define('_SETTINGS_NONMEMBERMSGS',	'Permitir que não membros enviem mensagens');
define('_SETTINGS_PROTECTMEMNAMES',	'Proteger nomes de membros');

// overview screen
define('_OVERVIEW_PLUGINS',			'Administração de plugins...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'Novo membro registrado:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'Seu e-mail:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'Você não possui autorização ou não pode enviar arquivos para o diretório');

// plugin list
define('_LISTS_INFO',				'Informação');
define('_LIST_PLUGS_AUTHOR',		'Author:');
define('_LIST_PLUGS_VER',			'Versão:');
define('_LIST_PLUGS_SITE',			'Site:');
define('_LIST_PLUGS_DESC',			'Descrição:');
define('_LIST_PLUGS_SUBS',			'Inscreva-se:');
define('_LIST_PLUGS_UP',			'para cima');
define('_LIST_PLUGS_DOWN',			'para baixo');
define('_LIST_PLUGS_UNINSTALL',		'desinstalar');
define('_LIST_PLUGS_ADMIN',			'admin');
define('_LIST_PLUGS_OPTIONS',		'editar opções');

// plugin option list
define('_LISTS_VALUE',				'Valor');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'este plugin não tem opções');
define('_PLUGS_BACK',				'Volta para a lista de plugins');
define('_PLUGS_SAVE',				'Gravar opções');
define('_PLUGS_OPTIONS_UPDATED',	'Opções de plugin atualizadas');

define('_OVERVIEW_MANAGEMENT',		'Administração');
define('_OVERVIEW_MANAGE',			'Administração do Nucleus...');
define('_MANAGE_GENERAL',			'Administração geral');
define('_MANAGE_SKINS',				'Skins e Templates');
define('_MANAGE_EXTRA',				'Extras');

define('_BACKTOMANAGE',				'Volta para a Administração do Nucleus');


// END introduced after v1.1 END

// charset to use 
define('_CHARSET',					'iso-8859-1');

// global stuff
define('_LOGOUT',					'Sair');
define('_LOGIN',					'Entrar');
define('_YES',						'Sim');
define('_NO',						'Não');
define('_SUBMIT',					'Envia');
define('_ERROR',					'Erro');
define('_ERRORMSG',					'Occorreu um erro!');
define('_BACK',						'Volta');
define('_NOTLOGGEDIN',				'Você não está logado');
define('_LOGGEDINAS',				'Você está logado como');
define('_ADMINHOME',				'Início');
define('_NAME',						'Nome');
define('_BACKHOME',					'Início');
define('_BADACTION',				'A ação solicitada não existe');
define('_MESSAGE',					'Mensagem');
define('_HELP_TT',					'Ajuda');
define('_YOURSITE',					'página inicial');


define('_POPUP_CLOSE',				'Fecha a janela');

define('_LOGIN_PLEASE',				'Por favor, faça o log in');

// commentform
define('_COMMENTFORM_YOUARE',		'Você está logado como');
define('_COMMENTFORM_SUBMIT',		'Envia');
define('_COMMENTFORM_COMMENT',		'Seu comentário');
define('_COMMENTFORM_NAME',			'Nome');
define('_COMMENTFORM_MAIL',			'E-mail ou site');
define('_COMMENTFORM_REMEMBER',		'auto-completar na próxima visita');

// loginform
define('_LOGINFORM_NAME',			'Nome');
define('_LOGINFORM_PWD',			'Senha');
define('_LOGINFORM_YOUARE',			'Olá, ');
define('_LOGINFORM_SHARED',			'Desativar login automático');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'Enviar');

// search form
define('_SEARCHFORM_SUBMIT',		'Buscar');

// add item form
define('_ADD_ADDTO',				'Novo post em');
define('_ADD_CREATENEW',			'Novo post');
define('_ADD_BODY',					'Corpo do texto');
define('_ADD_TITLE',				'Título');
define('_ADD_MORE',					'Texto extendido para o "leia mais&raquo;" (opcional)');
define('_ADD_CATEGORY',				'Tema');
define('_ADD_PREVIEW',				'Previsão');
define('_ADD_DISABLE_COMMENTS',		'Desativar comentários');
define('_ADD_DRAFTNFUTURE',			'Rascunhos &amp; itens futuros');
define('_ADD_ADDITEM',				'Novo post');
define('_ADD_ADDNOW',				'Publicar agora');
define('_ADD_ADDLATER',				'Publicar mais tarde');
define('_ADD_PLACE_ON',				'Publicar no dia');
define('_ADD_ADDDRAFT',				'Colocar nos rascunhos');
define('_ADD_NOPASTDATES',			'');
define('_ADD_BOLD_TT',				'Negrito');
define('_ADD_ITALIC_TT',			'Itálico');
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
define('_EDIT_COMMENTSNOTE',		'(desativar os comentários não oculta os já enviados)');

// used on delete screens
define('_DELETE_CONFIRM',			'Por favor, confirme ');
define('_DELETE_CONFIRM_BTN',		'confirma');
define('_CONFIRMTXT_ITEM',			'Você está prestes a excluir o seguinte post:');
define('_CONFIRMTXT_COMMENT',		'Você está prestes a excluir o seguinte comentário:');
define('_CONFIRMTXT_TEAM1',			'Você está prestes a excluir ');
define('_CONFIRMTXT_TEAM2',			' da equipe do blog ');
define('_CONFIRMTXT_BLOG',			'O blog que você vai excluir é: ');
define('_WARNINGTXT_BLOGDEL',		'<b>ATENçãO!</b><br />Ao excluir um blog você apagará todas os posts e todos os comentários deste blog.<br />Certifique-se do que está fazendo antes de confirmar esta ação! <br />');
define('_CONFIRMTXT_MEMBER',		'Você está prestes a excluir o seguinte membro: ');
define('_CONFIRMTXT_TEMPLATE',		'Você está prestes a excluir o template ');
define('_CONFIRMTXT_SKIN',			'Você está prestes a excluir a skin ');
define('_CONFIRMTXT_BAN',			'Você está prestes a cancelar o banimento do IP');
define('_CONFIRMTXT_CATEGORY',		'Você está prestes a excluir o tema ');

// some status messages
define('_DELETED_ITEM',				'Post excluído');
define('_DELETED_MEMBER',			'Membro excluído');
define('_DELETED_COMMENT',			'Comentário excluído');
define('_DELETED_BLOG',				'Blog excluído');
define('_DELETED_CATEGORY',			'Tema excluí;do');
define('_ITEM_MOVED',				'Post tranferido');
define('_ITEM_ADDED',				'Post publicado');
define('_COMMENT_UPDATED',			'Comentário editado');
define('_SKIN_UPDATED',				'A skin foi salva');
define('_TEMPLATE_UPDATED',			'O template foi salvo');

// errors
define('_ERROR_COMMENT_LONGWORD',	'Por favor, não use palavras com mais de 90 caracteres em seus comentários');
define('_ERROR_COMMENT_NOCOMMENT',	'Comente');
define('_ERROR_COMMENT_NOUSERNAME',	'Usuário desconhecido.');
define('_ERROR_COMMENT_TOOLONG',	'Seu comentário é longo demais. Escreva no máximo 5000 caracteres.');
define('_ERROR_COMMENTS_DISABLED',	'Comentários para este blog estão desabilitados.');
define('_ERROR_COMMENTS_NONPUBLIC',	'Você precisa estar logado como um membro para comentar este blog');
define('_ERROR_COMMENTS_MEMBERNICK','Você tentou assinar o comentário com um nome protegido. Esta assinatura só pode ser utilizada pelo usuário que a cadastrou.<br /><br />Por favor, volte à página anterior e tente novamente.');
define('_ERROR_SKIN',				'Erro de skin');
define('_ERROR_ITEMCLOSED',			'Este post não permite comentários');
define('_ERROR_NOSUCHITEM',			'Este post não existe.');
define('_ERROR_NOSUCHBLOG',			'Este blog não existe.');
define('_ERROR_NOSUCHSKIN',			'Esta skin não existe.');
define('_ERROR_NOSUCHMEMBER',		'Este membro não existe.');
define('_ERROR_NOTONTEAM',			'Você não pertence à equipe deste blog.');
define('_ERROR_BADDESTBLOG',		'O blog escolhido não existe.');
define('_ERROR_NOTONDESTTEAM',		'Não é possível mover o post: você não pertence à equipe do blog de destino.');
define('_ERROR_NOEMPTYITEMS',		'Não é posssível adicionar posts sem texto!');
define('_ERROR_BADMAILADDRESS',		'Endereço de e-mail inválido');
define('_ERROR_BADNOTIFY',			'Um ou mais e-mails não são válidos');
define('_ERROR_BADNAME',			'O nome é inválido. Use apenas letras e números, sem acentos e nem espaços no início ou no fim.');
define('_ERROR_NICKNAMEINUSE',		'Já existe um usuário com este apelido. Tente outro.');
define('_ERROR_PASSWORDMISMATCH',	'As senhas devem ser idênticas');
define('_ERROR_PASSWORDTOOSHORT',	'A senha precisa ter no mínimo 6 caracteres');
define('_ERROR_PASSWORDMISSING',	'Você não digitou uma senha');
define('_ERROR_REALNAMEMISSING',	'Você não digitou um nome real');
define('_ERROR_ATLEASTONEADMIN',	'é necessário pelo menos um super-admin que possa logar na área dministrativa.');
define('_ERROR_ATLEASTONEBLOGADMIN','Certifique-se de que há pelo menos um administrador.');
define('_ERROR_ALREADYONTEAM',		'Você não pode adicionar um membro que já pertence à equipe');
define('_ERROR_BADSHORTBLOGNAME',	'O nome resumido s&oacute pode conter a-z e 0-9, sem espaçoss');
define('_ERROR_DUPSHORTBLOGNAME',	'Outro blog já usa este nome resumido. Escolha outro');
define('_ERROR_UPDATEFILE',			'Não há acesso para atualizar o arquivo. Certifique-se de que as permissões estão configuradas corretamente (experimente colocar o chmod em 666). Perceba que a localização é relativa à área administrativa, por isso você pode querer usar o diret&oacuterio absoluto (algo como  /seu/diret&oacuterio/do/nucleus/)');
define('_ERROR_DELDEFBLOG',			'Não é possível excluir o blog padrão');
define('_ERROR_DELETEMEMBER',		'este membro não pode ser excluído, provavelmente porque ele é autor de posts ou comentários');
define('_ERROR_BADTEMPLATENAME',	'Nome de template inválido. Use apenas a-z e 0-9, sem espaços');
define('_ERROR_DUPTEMPLATENAME',	'Já existe um template com este nome');
define('_ERROR_BADSKINNAME',		'Nome de skin inválido. Use apenas a-z e 0-9, sem espaços');
define('_ERROR_DUPSKINNAME',		'Já existe uma skin com este nome');
define('_ERROR_DEFAULTSKIN',		'Sempre deve haver uma skin com o nome "default"');
define('_ERROR_SKINDEFDELETE',		'Não é possível excluir esta skin porque ela é usada pelo segunte blog: ');
define('_ERROR_DISALLOWED',			'Você não está autorizado a fazer isso');
define('_ERROR_DELETEBAN',			'Erro ao tentar excluir o banimento (o ban não existe)');
define('_ERROR_ADDBAN',				'Erro ao tentar adiconar um banimento. O IP banido pode não ter sido corretamente adicionado aos seus blogs.');
define('_ERROR_BADACTION',			'Esta ação não existe');
define('_ERROR_MEMBERMAILDISABLED',	'E-mail membro a membro está desabilitado');
define('_ERROR_MEMBERCREATEDISABLED','Criação de contas está desabilitada');
define('_ERROR_INCORRECTEMAIL',		'E-mail incorreto');
define('_ERROR_VOTEDBEFORE',		'Você já votou neste post');
define('_ERROR_BANNED1',			'Não é possível executar a ação porque o seu IP (');
define('_ERROR_BANNED2',			') está banido. A razão para isso é: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'Você precisa estar logado para executar esta ação');
define('_ERROR_CONNECT',			'Erro de conexão');
define('_ERROR_FILE_TOO_BIG',		'Arquivo grande demais!');
define('_ERROR_BADFILETYPE',		'Este tipo de arquivo não é permitido');
define('_ERROR_BADREQUEST',			'Ocorreu um problema no envio do arquivo');
define('_ERROR_DISALLOWEDUPLOAD',	'Você não pertence a nenhuma equipe de blog e por isso não pode enviar arquivos');
define('_ERROR_BADPERMISSIONS',		'Permissão de diret&oacuterio não estão configuradas corretamente');
define('_ERROR_UPLOADMOVEP',		'Ocorreu um problema ao enviar o arquivo');
define('_ERROR_UPLOADCOPY',			'Ocorreu um problema ao copiar o arquivo');
define('_ERROR_UPLOADDUPLICATE',	'Já existe um arquivo com este nome. Renomeie antes de enviar.');
define('_ERROR_LOGINDISALLOWED',	'Você não pode logar. Tente usar outro usuário.');
define('_ERROR_DBCONNECT',			'Não foi possível conectar com o servidor mySQL.');
define('_ERROR_DBSELECT',			'Não foi posssível acessar o banco de dados nucleus.');
define('_ERROR_NOSUCHLANGUAGE', 'Esta língua não existe');
define('_ERROR_NOSUCHCATEGORY', 'Este tema não existe');
define('_ERROR_DELETELASTCATEGORY', 'É preciso haver ao menos um tema');
define('_ERROR_DELETEDEFCATEGORY', 'Você não pode apagar o tema');
define('_ERROR_BADCATEGORYNAME', 'Este nome não pode ser usado para um tema');
define('_ERROR_DUPCATEGORYNAME', 'Já existe um tema com este nome');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Aviso: este não é um diret&oacuterio válido!');
define('_WARNING_NOTREADABLE',		'Aviso: este diret&oacuterio não pode ser lido!');
define('_WARNING_NOTWRITABLE',		'Aviso: este diret&oacuterio não tem permissão de escrita!');

// media and upload
define('_MEDIA_UPLOADLINK',			'Enviar um novo arquivo');
define('_MEDIA_MODIFIED',			'modificado');
define('_MEDIA_FILENAME',			'arquivo');
define('_MEDIA_DIMENSIONS',			'dimensões');
define('_MEDIA_INLINE',				'Na página');
define('_MEDIA_POPUP',				'Em janela popup');
define('_UPLOAD_TITLE',				'Escolha o arquivo');
define('_UPLOAD_MSG',				'Escolha o arquivo que você deseja enviar e clique no botão "Envia".');
define('_UPLOAD_BUTTON',			'Enviar');

// some status messages
define('_MSG_ACCOUNTCREATED',		'Conta criada. A senha será enviada por e-mail.');
define('_MSG_PASSWORDSENT',			'A senha foi enviada por e-mail.');
define('_MSG_LOGINAGAIN',			'Você precisa logar de novo, porque suas indformações foram alteradas');
define('_MSG_SETTINGSCHANGED',		'Configurações alteradas');
define('_MSG_ADMINCHANGED',			'Administrador alterado');
define('_MSG_NEWBLOG',				'Novo blog criado');
define('_MSG_ACTIONLOGCLEARED',		'O log foi limpo');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'Ação não permitida: ');
define('_ACTIONLOG_PWDREMINDERSENT','A nova senha foi enviada para ');
define('_ACTIONLOG_TITLE',			'Arquivo de log');
define('_ACTIONLOG_CLEAR_TITLE',	'Limpa o log');
define('_ACTIONLOG_CLEAR_TEXT',		'Limpa o log agora');

// team management
define('_TEAM_TITLE',				'Equipe do blog ');
define('_TEAM_CURRENT',				'Equipe atual');
define('_TEAM_ADDNEW',				'Novo membro');
define('_TEAM_CHOOSEMEMBER',		'Escolha o membro');
define('_TEAM_ADMIN',				'Privilégios de administrador? ');
define('_TEAM_ADD',					'Adicionar à equipe');
define('_TEAM_ADD_BTN',				'Adicionar à equipe');

// blogsettings
define('_EBLOG_TITLE',				'Configurações do blog');
define('_EBLOG_TEAM_TITLE',			'Alterar equipe');
define('_EBLOG_TEAM_TEXT',			'Clique aqui para alterar a equipe deste blog.');
define('_EBLOG_SETTINGS_TITLE',		'Configurações do blog');
define('_EBLOG_NAME',				'Nome');
define('_EBLOG_SHORTNAME',			'Nome resumido');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(use apenas a-z e 0-9, sem espaços)');
define('_EBLOG_DESC',				'Descrição');
define('_EBLOG_URL',				'Endereço (http://...)');
define('_EBLOG_DEFSKIN',			'Skin padrão');
define('_EBLOG_DEFCAT',				'Categoria padrão');
define('_EBLOG_LINEBREAKS',			'Converter quebras de linhas?');
define('_EBLOG_DISABLECOMMENTS',	'Habilitar comentários?');
define('_EBLOG_ANONYMOUS',			'Permitir comentários de não-membros?');
define('_EBLOG_NOTIFY',				'Avisar e-mails (use ; para separar)');
define('_EBLOG_NOTIFY_ON',			'Aviso ligado para');
define('_EBLOG_NOTIFY_COMMENT',		'Novos comentários');
define('_EBLOG_NOTIFY_KARMA',		'Novos votos de karma');
define('_EBLOG_NOTIFY_ITEM',		'Novos posts no blog');
define('_EBLOG_PING',				'Dar ping no Weblogs.com?');
define('_EBLOG_MAXCOMMENTS',		'Número máximo de comentários');
define('_EBLOG_UPDATE',				'Atualiza arquivo');
define('_EBLOG_OFFSET',				'Diferença de fuso');
define('_EBLOG_STIME',				'A hora atual no servidor é');
define('_EBLOG_BTIME',				'A hora atual no blog é');
define('_EBLOG_CHANGE',				'Salvar alterações');
define('_EBLOG_CHANGE_BTN',			'Salvar alterações');
define('_EBLOG_ADMIN',				'Administrador do blog');
define('_EBLOG_ADMIN_MSG',			'Você terá privilégios de administrador');
define('_EBLOG_CREATE_TITLE',		'Criar novo blog');
define('_EBLOG_CREATE_TEXT',		'Preencha os campos abaixo para criar um novo blog. <br /><br /> <b>Nota:</b> Apenas os campos necessários estão listados. Se você quer configurar opções extras, acesse as configurações do blog depois de criá-lo.');
define('_EBLOG_CREATE',				'Cria o blog!');
define('_EBLOG_CREATE_BTN',			'Cria um novo blog');
define('_EBLOG_CAT_TITLE',			'Categorias');
define('_EBLOG_CAT_NAME',			'Nome da categoria');
define('_EBLOG_CAT_DESC',			'Descrição da categoria');
define('_EBLOG_CAT_CREATE',			'Criar nova categoria');
define('_EBLOG_CAT_UPDATE',			'Alterar cateforia');
define('_EBLOG_CAT_UPDATE_BTN',		'Alterar categoria');

// templates
define('_TEMPLATE_TITLE',			'Edita templates');
define('_TEMPLATE_AVAILABLE_TITLE',	'Templates disponíveis');
define('_TEMPLATE_NEW_TITLE',		'Novo template');
define('_TEMPLATE_NAME',			'Nome do template');
define('_TEMPLATE_DESC',			'Descrição do template');
define('_TEMPLATE_CREATE',			'Cria template');
define('_TEMPLATE_CREATE_BTN',		'Cria template');
define('_TEMPLATE_EDIT_TITLE',		'Edita template');
define('_TEMPLATE_BACK',			'Volta para a lista de templates');
define('_TEMPLATE_EDIT_MSG',		'Nem todas as partes do template são necessárias. Deixe em branco as que não for utilizar.');
define('_TEMPLATE_SETTINGS',		'Configurações do template');
define('_TEMPLATE_ITEMS',			'Posts');
define('_TEMPLATE_ITEMHEADER',		'Cabeçalhos dos posts');
define('_TEMPLATE_ITEMBODY',		'Corpo dos posts');
define('_TEMPLATE_ITEMFOOTER',		'Fim dos posts');
define('_TEMPLATE_MORELINK',		'Link para o texto extendido');
define('_TEMPLATE_NEW',				'Indicação de novo post');
define('_TEMPLATE_COMMENTS_ANY',	'Comentários (se houver)');
define('_TEMPLATE_CHEADER',			'Cabeçalho dos comentários');
define('_TEMPLATE_CBODY',			'Corpo dos comentários');
define('_TEMPLATE_CFOOTER',			'Fim dos comentários');
define('_TEMPLATE_CONE',			'Um comentário');
define('_TEMPLATE_CMANY',			'Dois ou mais comentários');
define('_TEMPLATE_CMORE',			'Leia mais nos comentários');
define('_TEMPLATE_CMEXTRA',			'Extras dos membros');
define('_TEMPLATE_COMMENTS_NONE',	'Comentários (se não tiver nenhum)');
define('_TEMPLATE_CNONE',			'Nenhum comentário');
define('_TEMPLATE_COMMENTS_TOOMUCH','Comentários (se houver, mas longos demais para serem mostrados)');
define('_TEMPLATE_CTOOMUCH',		'Comentários demais');
define('_TEMPLATE_ARCHIVELIST',		'Listagem de arquivo');
define('_TEMPLATE_AHEADER',			'Cabeçalho do arquivo');
define('_TEMPLATE_AITEM',			'Lista de posts no arquivo');
define('_TEMPLATE_AFOOTER',			'Fim do arquivo');
define('_TEMPLATE_DATETIME',		'Data e hora');
define('_TEMPLATE_DHEADER',			'Cabeçalho da data');
define('_TEMPLATE_DFOOTER',			'Fim da data');
define('_TEMPLATE_DFORMAT',			'Formato da data');
define('_TEMPLATE_TFORMAT',			'Formato da hora');
define('_TEMPLATE_LOCALE',			'Locale');
define('_TEMPLATE_IMAGE',			'Janelas popup para imagens');
define('_TEMPLATE_PCODE',			'Código das janelas popup');
define('_TEMPLATE_ICODE',			'Código das imagens na página');
define('_TEMPLATE_MCODE',			'Código de link para outras mídias');
define('_TEMPLATE_SEARCH',			'Busca');
define('_TEMPLATE_SHIGHLIGHT',		'Sublinhado');
define('_TEMPLATE_SNOTFOUND',		'Nada encontrado na busca');
define('_TEMPLATE_UPDATE',			'Atualiza');
define('_TEMPLATE_UPDATE_BTN',		'Altera template');
define('_TEMPLATE_RESET_BTN',		'Limpa');
define('_TEMPLATE_CATEGORYLIST',	'Listas de temas');
define('_TEMPLATE_CATHEADER',		'Cabeçalho da lista de temas');
define('_TEMPLATE_CATITEM',			'Item da lista de temas');
define('_TEMPLATE_CATFOOTER',		'Fim da lista de temas');

// skins
define('_SKIN_EDIT_TITLE',			'Edita skins');
define('_SKIN_AVAILABLE_TITLE',		'Skins disponíveis');
define('_SKIN_NEW_TITLE',			'Nova skin');
define('_SKIN_NAME',				'Nome');
define('_SKIN_DESC',				'Descrição');
define('_SKIN_TYPE',				'Tipo de conteúdo');
define('_SKIN_CREATE',				'Cria');
define('_SKIN_CREATE_BTN',			'Cria skin');
define('_SKIN_EDITONE_TITLE',		'Edita skin');
define('_SKIN_BACK',				'Volta para a lista de skins');
define('_SKIN_PARTS_TITLE',			'Partes da skin');
define('_SKIN_PARTS_MSG',			'Nem todas as partes da skin são necessárias. Deixe em branco as que não for utilizar.');
define('_SKIN_PART_MAIN',			'Página inicial');
define('_SKIN_PART_ITEM',			'Posts individuais');
define('_SKIN_PART_ALIST',			'Lista de arquivos');
define('_SKIN_PART_ARCHIVE',		'Arquivo');
define('_SKIN_PART_SEARCH',			'Busca');
define('_SKIN_PART_ERROR',			'Erro');
define('_SKIN_PART_MEMBER',			'Detalhes dos membros');
define('_SKIN_PART_POPUP',			'Janelas popups de imagem');
define('_SKIN_GENSETTINGS_TITLE',	'Configurações gerais');
define('_SKIN_CHANGE',				'Altera');
define('_SKIN_CHANGE_BTN',			'Altera configurações');
define('_SKIN_UPDATE_BTN',			'Atualiza skin');
define('_SKIN_RESET_BTN',			'Limpa');
define('_SKIN_EDITPART_TITLE',		'Edita skin');
define('_SKIN_GOBACK',				'Volta');
define('_SKIN_ALLOWEDVARS',			'Variáveis disponíveis (clique para mais informações):');

// global settings
define('_SETTINGS_TITLE',			'Configurações gerais');
define('_SETTINGS_SUB_GENERAL',		'Configurações gerais');
define('_SETTINGS_DEFBLOG',			'Blog padrão');
define('_SETTINGS_ADMINMAIL',		'E-mail do adminstrador');
define('_SETTINGS_SITENAME',		'Nome do site');
define('_SETTINGS_SITEURL',			'Endereço do site (deve terminar com uma barra)');
define('_SETTINGS_ADMINURL',		'Endereço da área administrativa (deve terminar com uma barra)');
define('_SETTINGS_DIRS',			'Diretórios do Nucleus');
define('_SETTINGS_MEDIADIR',		'Diretório da mídia');
define('_SETTINGS_SEECONFIGPHP',	'(veja config.php)');
define('_SETTINGS_MEDIAURL',		'Endereço da mídia (deve terminar com uma barra)');
define('_SETTINGS_ALLOWUPLOAD',		'Permite envio de arquivos?');
define('_SETTINGS_ALLOWUPLOADTYPES','Tipos de arquivos permitidos para envio');
define('_SETTINGS_CHANGELOGIN',		'Permite que membros alterem Login/Senha');
define('_SETTINGS_COOKIES_TITLE',	'Configurações do cookie');
define('_SETTINGS_COOKIELIFE',		'Cookie por tempo de expiração');
define('_SETTINGS_COOKIESESSION',	'Cookie por sessão');
define('_SETTINGS_COOKIEMONTH',		'Expiração de um mês');
define('_SETTINGS_COOKIEPATH',		'Local do cookie (avançado)');
define('_SETTINGS_COOKIEDOMAIN',	'Domínio do cookie (avançado)');
define('_SETTINGS_COOKIESECURE',	'Cookie seguro (avançado)');
define('_SETTINGS_LASTVISIT',		'Gravar cookies das &uacuteltimas visitas');
define('_SETTINGS_ALLOWCREATE',		'Permitir que usuários criem novas contas');
define('_SETTINGS_NEWLOGIN',		'Permitir login para as contas criadas por usuários');
define('_SETTINGS_NEWLOGIN2',		'(apenas para as novas contas criadas)');
define('_SETTINGS_MEMBERMSGS',		'Permitir serviço membro-a-membro');
define('_SETTINGS_LANGUAGE',		'Linguagem padrão');
define('_SETTINGS_DISABLESITE',		'Desabilitar o site');
define('_SETTINGS_DBLOGIN',			'Login do banco de dados mySQL');
define('_SETTINGS_UPDATE',			'Atualiza configurações');
define('_SETTINGS_UPDATE_BTN',		'Atualiza configurações');
define('_SETTINGS_DISABLEJS',		'Desabilitar barra de ferramentas em javaScript');
define('_SETTINGS_MEDIA',			'Configurações do envio de arquivos');
define('_SETTINGS_MEDIAPREFIX',		'Colocar data no prefixo dos arquivos enviados');
define('_SETTINGS_MEMBERS',			'Configurações dos membros');

// bans
define('_BAN_TITLE',				'Lista de IPs banidos do blog');
define('_BAN_NONE',					'Nenhum IP foi banido para este blog');
define('_BAN_NEW_TITLE',			'Banir novo IP');
define('_BAN_NEW_TEXT',				'Banir novo IP');
define('_BAN_REMOVE_TITLE',			'Remover IP banido');
define('_BAN_IPRANGE',				'IP');
define('_BAN_BLOGS',				'Que blogs?');
define('_BAN_DELETE_TITLE',			'Exclui IP banido');
define('_BAN_ALLBLOGS',				'Todos os blogs que você tem privilégios de administrador.');
define('_BAN_REMOVED_TITLE',		'O IP banido foi removido');
define('_BAN_REMOVED_TEXT',			'O IP banido foi removido dos seguintes blogs:');
define('_BAN_ADD_TITLE',			'Banir novo IP');
define('_BAN_IPRANGE_TEXT',			'Escolha o raio de ação do IP banido. Quanto menos n&uacutemeros, mais endereços serão bloqueados.');
define('_BAN_BLOGS_TEXT',			'Você pode banir o IP de apenas um blog ou bloquear o IP de todos os blogs que você possui privilégios de administrador. Escolha abaixo.');
define('_BAN_REASON_TITLE',			'Razão');
define('_BAN_REASON_TEXT',			'Você pode colocar uma razão para o banimento, que será mostrada se o IP tentar adicionar um comentário. Use no máximo 256 caracteres.');
define('_BAN_ADD_BTN',				'Banir novo IP');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Mensagem');
define('_LOGIN_NAME',				'Nome');
define('_LOGIN_PASSWORD',			'Senha');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'Esqueceu sua senha?');

// membermanagement
define('_MEMBERS_TITLE',			'Administração de membros');
define('_MEMBERS_CURRENT',			'Membros');
define('_MEMBERS_NEW',				'Novo membro');
define('_MEMBERS_DISPLAY',			'Apelido');
define('_MEMBERS_DISPLAY_INFO',		'(Este é o nome que você usa para logar)');
define('_MEMBERS_REALNAME',			'Nome real');
define('_MEMBERS_PWD',				'Senha');
define('_MEMBERS_REPPWD',			'Repita a senha');
define('_MEMBERS_EMAIL',			'E-mail');
define('_MEMBERS_EMAIL_EDIT',		'(quando você altera o e-mail, uma nova senha é enviada para o novo endereço automaticamente)');
define('_MEMBERS_URL',				'Endereço do blog');
define('_MEMBERS_SUPERADMIN',		'Privilégios de administrador');
define('_MEMBERS_CANLOGIN',			'Pode logar na área administrativa');
define('_MEMBERS_NOTES',			'Notas');
define('_MEMBERS_NEW_BTN',			'Novo membro');
define('_MEMBERS_EDIT',				'Perfil');
define('_MEMBERS_EDIT_BTN',			'Salvar alterações');
define('_MEMBERS_BACKTOOVERVIEW',	'Voltar para a lista de membros');
define('_MEMBERS_DEFLANG',			'Língua');
define('_MEMBERS_USESITELANG',		'- configurações do site -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'Visitar');
define('_BLOGLIST_ADD',				'Novo post');
define('_BLOGLIST_TT_ADD',			'Novo post para este blog');
define('_BLOGLIST_EDIT',			'Editar posts');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Atalho');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'Configurações');
define('_BLOGLIST_TT_SETTINGS',		'Edita configurações ou administra time');
define('_BLOGLIST_BANS',			'Banidos');
define('_BLOGLIST_TT_BANS',			'Vê, adicona ou remove IPs banidos');
define('_BLOGLIST_DELETE',			'Excluir este blog');
define('_BLOGLIST_TT_DELETE',		'Exclui este blog');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'Seus blogs');
define('_OVERVIEW_YRDRAFTS',		'Seus rascunhos');
define('_OVERVIEW_YRSETTINGS',		'Configurações');
define('_OVERVIEW_GSETTINGS',		'Configurações gerais');
define('_OVERVIEW_NOBLOGS',			'Você não pertence a nenhuma equipe');
define('_OVERVIEW_NODRAFTS',		'Nenhum rascunho');
define('_OVERVIEW_EDITSETTINGS',	'Alterar seu perfil...');
define('_OVERVIEW_BROWSEITEMS',		'Explora os posts...');
define('_OVERVIEW_BROWSECOMM',		'Explora seus comentários...');
define('_OVERVIEW_VIEWLOG',			'Ver Log...');
define('_OVERVIEW_MEMBERS',			'Altera membros...');
define('_OVERVIEW_NEWLOG',			'Cria novo blog...');
define('_OVERVIEW_SETTINGS',		'Edita configurações...');
define('_OVERVIEW_TEMPLATES',		'Edita templates...');
define('_OVERVIEW_SKINS',			'Edita skins...');
define('_OVERVIEW_BACKUP',			'Faz backup/restaura o banco de dados...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Posts do blog'); 
define('_ITEMLIST_YOUR',			'Seus posts');

// Comments
define('_COMMENTS',					'Comentários');
define('_NOCOMMENTS',				'Nenhum comentário para este post');
define('_COMMENTS_YOUR',			'Seus comentários');
define('_NOCOMMENTS_YOUR',			'Você não escreveu nenhum comentário');

// LISTS (general)
define('_LISTS_NOMORE',				'Nenhum post encontrado');
define('_LISTS_PREV',				'Anterior');
define('_LISTS_NEXT',				'Próxima');
define('_LISTS_SEARCH',				'Busca');
define('_LISTS_CHANGE',				'Altera');
define('_LISTS_PERPAGE',			'posts por página');
define('_LISTS_ACTIONS',			'Ações');
define('_LISTS_DELETE',				'Exclui');
define('_LISTS_EDIT',				'Edita');
define('_LISTS_MOVE',				'Move');
define('_LISTS_CLONE',				'Duplica');
define('_LISTS_TITLE',				'Título');
define('_LISTS_BLOG',				'Blog');
define('_LISTS_NAME',				'Nome');
define('_LISTS_DESC',				'Descrição');
define('_LISTS_TIME',				'Time');
define('_LISTS_COMMENTS',			'Comentários');
define('_LISTS_TYPE',				'Tipo');


// member list 
define('_LIST_MEMBER_NAME',			'Apelido');
define('_LIST_MEMBER_RNAME',		'Nome real');
define('_LIST_MEMBER_ADMIN',		'Super-admin? ');
define('_LIST_MEMBER_LOGIN',		'Pode logar? ');
define('_LIST_MEMBER_URL',			'Site');

// banlist
define('_LIST_BAN_IPRANGE',			'IP Banido');
define('_LIST_BAN_REASON',			'Razão');

// actionlist
define('_LIST_ACTION_MSG',			'Mensagem');

// commentlist
define('_LIST_COMMENT_BANIP',		'Bane IP');
define('_LIST_COMMENT_WHO',			'Autor');
define('_LIST_COMMENT',				'Comentário');
define('_LIST_COMMENT_HOST',		'IP');

// itemlist
define('_LIST_ITEM_INFO',			'Info');
define('_LIST_ITEM_CONTENT',		'Título e texto do post');


// teamlist
define('_LIST_TEAM_ADMIN',			'Administrador ');
define('_LIST_TEAM_CHADMIN',		'Altera Administrador');

// edit comments
define('_EDITC_TITLE',				'Alterar comentários');
define('_EDITC_WHO',				'Autor');
define('_EDITC_HOST',				'De onde?');
define('_EDITC_WHEN',				'Quando?');
define('_EDITC_TEXT',				'Texto');
define('_EDITC_EDIT',				'Edita comentário');
define('_EDITC_MEMBER',				'membro');
define('_EDITC_NONMEMBER',			'não membro');

// move item
define('_MOVE_TITLE',				'Mover o post para qual blog?');
define('_MOVE_BTN',					'Mover');

?>