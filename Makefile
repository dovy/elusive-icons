PATH := ../node_modules/.bin:$(PATH)

EI_ROOT_DIRECTORY = assets/elusive-icons
EI_LESS_DIRECTORY = assets/elusive-icons/less
EI_SCSS_DIRECTORY = assets/elusive-icons/scss
EI_CSS_DIRECTORY = assets/elusive-icons/css

EI_LESS_MODERN = ${EI_LESS_DIRECTORY}/elusive-icons.less
EI_SCSS_MODERN = ${EI_SCSS_DIRECTORY}/elusive-icons.scss

EI_CSS_MODERN = ${EI_CSS_DIRECTORY}/elusive-icons.css
EI_CSS_MODERN_MIN = ${EI_CSS_DIRECTORY}/elusive-icons.min.css

SITE_LESS_DIRECTORY = assets/less
SITE_CSS_DIRECTORY = assets/css

SITE_LESS = ${SITE_LESS_DIRECTORY}/site.less
SITE_CSS = ${SITE_CSS_DIRECTORY}/site.css

build:
	@echo "Compiling Less files"
	@mkdir -p ${EI_CSS_DIRECTORY}

	lessc ${EI_LESS_MODERN} > ${EI_CSS_MODERN}
	lessc --compress ${EI_LESS_MODERN} > ${EI_CSS_MODERN_MIN}
#	sass ${EI_SCSS_MODERN} ${EI_CSS_MODERN}

	lessc --yui-compress ${SITE_LESS} > ${SITE_CSS}
	#yui-compressor ${SITE_CSS}
	cp -r ${EI_ROOT_DIRECTORY}/* ../
	mv README.md-nobuild ../README.md
	cd assets && mv elusive-icons elusive-icons-2.0.0 && zip -r9 elusive-icons-2.0.0.zip elusive-icons-2.0.0 && mv elusive-icons-2.0.0 elusive-icons

	find .. -type f ! -perm 644 -exec chmod 644 {} \;

default: build


.PHONY: build
