function normalize(str) {
    str = str.toLowerCase();
    str = str.replace(/\\s/g, "");
    str = str.replace(/[àáâãäå]/g, "a");
    str = str.replace(/æ/g, "ae");
    str = str.replace(/’/g, "'");
    str = str.replace(/[“”«»]/g, "");
    str = str.replace(/ç/g, "c");
    str = str.replace(/[èéêë]/g, "e");
    str = str.replace(/[ìíîï]/g, "i");
    str = str.replace(/ñ/g, "n");
    str = str.replace(/[òóôõö]/g, "o");
    str = str.replace(/œ/g, "oe");
    str = str.replace(/[ùúûü]/g, "u");
    str = str.replace(/[ýÿ]/g, "y");
    str = str.replace(/\\W/g, "");
    return str.trim();
}
