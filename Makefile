.PHONY: build tools tests code-coverage linting

build: 
	@composer install

tools:
	@echo $@  # print target name
	@echo Checking toolchain
ifeq (,$(wildcard ${CURDIR}/vendor/bin/phpcs))
	@make build
else
	@echo squizlabs/php_codesniffer phpcs ready!
endif

ifeq (,$(wildcard ${CURDIR}/vendor/bin/phpcbf))
	@make build
else
	@echo squizlabs/php_codesniffer phpcbf ready!
endif

ifeq (,$(wildcard ${CURDIR}/vendor/bin/phpmd))
	@make build
else
	@echo phpmd/phpmd ready!
endif

ifeq (,$(wildcard ${CURDIR}/vendor/bin/phpunit))
	@make build
else
	@echo phpunit/phpunit ready!
endif

tests: tools
	@./vendor/bin/phpunit --configuration phpunit.xml

code-coverage: tools
	@./vendor/bin/phpunit --coverage-html code-coverage/

linting: tools
	@./vendor/bin/phpmd example,src text cleancode,codesize,controversial,design,naming,unusedcode
	@./vendor/bin/phpcs --standard=PSR12 src example test --colors
	@./vendor/bin/phpcbf --standard=PSR12 src example test --colors