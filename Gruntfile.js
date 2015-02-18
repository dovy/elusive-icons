
module.exports = function(grunt) {
    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        watch: {
            fonts: {
                files: ['svg/*.svg'],
                tasks: ['webfont']
            }
        },
        webfont: {
            iconsLESS: {
                src: 'dev/icons-svg/*.svg',
                dest: 'src/assets/elusive-icons/fonts',
                engine: "node",
                options: {
                    fontHeight: 1200,
                    //descent: -75,
                    font: 'elusiveicons',
                    types: "eot,woff,ttf,svg",
                    templateOptions: {
                        baseClass: 'el',
                        classPrefix: 'el-',
                        //mixinPrefix: 'el-'
                    },

                    //destCss: false,
                    //htmlDemo: false,
                    //ligatures: true,
                    //template: 'fusion-icon/template/template.css',
                    //stylesheet: "less",
                    destHtml: false,
                    //htmlDemoTemplate: "fusion-icon/template/template.html",
                    //ie7: true,
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-webfont');

    grunt.registerTask('default', ['webfont']);

};
