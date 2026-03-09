module.exports = {
    'resources/js/**/src/**/*.{css,js,vue,ts,tsx,json}': (filenames) =>
        filenames.map((filename) => `prettier --write '${filename}'`),

    'resources/js/**/*.{css,js,vue,ts,tsx,json}': () => ['yarn tscheck', 'yarn frontend-all', 'git add ./resources/js/*/dist/**'],
};
