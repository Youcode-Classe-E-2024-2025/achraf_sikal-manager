function admin() {
    document.getElementById("admin").classList.remove("hidden");
    // document.getElementById("admin").classList.add("grid");
    document.getElementById("user").classList.add("hidden");
    document.getElementById("dash").classList.add("hidden");
}
function user() {
    document.getElementById("user").classList.remove("hidden");
    // document.getElementById("user").classList.add("grid");
    document.getElementById("admin").classList.add("hidden");
    document.getElementById("dash").classList.add("hidden");
}
function dash() {
    document.getElementById("dash").classList.remove("hidden");
    // document.getElementById("dash").classList.add("grid");
    document.getElementById("user").classList.add("hidden");
    document.getElementById("admin").classList.add("hidden");
}