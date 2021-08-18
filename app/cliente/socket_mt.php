<?php
/*************************************************************************
Created : Mauricio Sánchez Sierra
Date: 2021-07-07
Description: Trabajo para Multi-Threading.
**************************************************************************/
/* {{{ proto resource socket_create(int domain, int type, int protocol) U   Creates an endpoint for communication in the domain specified by domain, of type specified by type */
PHP_FUNCTION(socket_create){        
long arg1, arg2, arg3;        
php_socket*php_sock = (php_socket*)emalloc(sizeof(php_socket));         
if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "lll", &arg1, &arg2, &arg3) == FAILURE) {                
	efree(php_sock);                
	return;        
}         
if (arg1 != AF_UNIX#if HAVE_IPV6                && arg1 != AF_INET6#endif                && arg1 != AF_INET) 
{                
	php_error_docref(NULL TSRMLS_CC, E_WARNING, "invalid socket domain [%ld] specified for argument 1, assuming AF_INET", arg1);arg1 = AF_INET;        
}         
if (arg2 > 10) {                
	php_error_docref(NULL TSRMLS_CC, E_WARNING, "invalid socket type [%ld] specified for argument 2, assuming SOCK_STREAM", arg2);           arg2 = SOCK_STREAM;        
}         
php_sock->bsd_socket = socket(arg1, arg2, arg3);        
php_sock->type = arg1;         
if (IS_INVALID_SOCKET(php_sock)) {                
	SOCKETS_G(last_error) = errno;                
	php_error_docref(NULL TSRMLS_CC, E_WARNING, "Unable to create socket [%d]: %s", errno, php_strerror(errno TSRMLS_CC));                efree(php_sock);                
	RETURN_FALSE;        
}         
php_sock->error = 0;        
php_sock->blocking = 1;
?>