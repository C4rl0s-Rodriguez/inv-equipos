var callAddFont = function () {
this.addFileToVFS('calibri-regular-normal.ttf', font);
this.addFont('calibri-regular-normal.ttf', 'calibri-regular', 'normal');
};
jsPDF.API.events.push(['addFonts', callAddFont])