function openfiltre(){
    document.getElementById("fitlre_pop_up").classList.toggle("dis_pop_up");
}

function sorting(tag) {
    var items = $('div.user').sort(function(a, b) {
        var txt1 = $.trim($('div.' + tag, a).text()),
            txt2 = $.trim($('div.' + tag, b).text());
        if (txt1 > txt2) return 1;
        else return -1;
    });
    return items;
}

$('.fitlre_pop_up a').on('click', function(e) {
    e.preventDefault();
    $('div.all_users').html(sorting(this.id));
});