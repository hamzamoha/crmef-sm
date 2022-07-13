class NotPassedException extends Error {
    //
}
class PassedException extends Error {
    //
}
function e() {
    try {
        throw 3
    } catch (e) {
        if (e === 0) return "Goo";
        if (e === 1) return "Stop";
        else return "Bluh";
    }
}

console.log(e());