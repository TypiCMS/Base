if ($('#table').length) {
    window.vm = new Vue({
        el: '#table',
        methods: {
            deleteMe: function (id) {
                alert("Delete " + id);
            },
            toggle: function (id) {
                alert("Toggle " + id);
            }
        },
        data: {
            loading: false,
            tableData: [],
            columns: columns,
            options: options
        }
    });

    var timeout;
    vm.$on('vue-tables.loaded', function() {
        window.clearTimeout(timeout);
        this.loading = false;
    });

    vm.$on('vue-tables.loading', function() {
        var $this = this;
        timeout = window.setTimeout(function(){
            $this.loading = true;
        }, 1000);
    });
}
