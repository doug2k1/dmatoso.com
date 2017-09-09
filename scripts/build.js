const ejs = require('ejs')
const fse = require('fs-extra')
const path = require('path')
const recursive = require('recursive-readdir')
const { promisify } = require('util')
const config = require('../site-config')

const srcPath = './src'
const distPath = './public'
const layoutFile = `${srcPath}/layout.ejs`
const ejsRenderFile = promisify(ejs.renderFile)
const readDirP = promisify(recursive)

// copy assets
fse.copy(`${srcPath}/assets`, `${distPath}/assets`)

// read pages templates
readDirP(`${srcPath}/pages`)
  .then((files) => {
    files.forEach((file) => {
      const pathData = path.parse(file)
      const destPath = path.join(distPath, pathData.dir.split(path.sep).splice(2).join(path.sep))
      const pageData = {}

      fse.mkdirs(destPath)
        .then(() => {
          // render page
          return ejsRenderFile(file, Object.assign({}, config, { page: pageData }))
        })
        .then((str) => {
          // render layout
          return ejsRenderFile(layoutFile, Object.assign({}, config, { body: str, page: pageData }))
        })
        .then((str) => {
          // save html
          fse.writeFile(`${destPath}/${pathData.name}.html`, str)
        })
    })
  })
