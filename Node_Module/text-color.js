let info = (s) => {
    return `\x1b[36m${s}\x1b[37m`;
}

let success = (s) => {
    return `\x1b[32m${s}\x1b[37m`;
}

let error = (s) => {
    return `\x1b[31m${s}\x1b[37m`;
}

let warning = (s) => {
    return `\x1b[33m${s}\x1b[37m`;
}

exports.info = info;
exports.success = success;
exports.error = error;
exports.warning = warning;