let text = (c, s) => {
    if (c === 'info') {
        return `\x1b[36m${s}\x1b[37m`;
    } else if (c === 'suc') {
        return `\x1b[32m${s}\x1b[37m`;
    } else if (c === 'error') {
        return `\x1b[31m${s}\x1b[37m`;
    } else if (c === 'warning') {
        return `\x1b[33m${s}\x1b[37m`;
    } else {
        return s;
    }
}

exports.text = text;