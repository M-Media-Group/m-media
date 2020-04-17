<!-- <table-component :columns="['test 1', 'test 2']" :rows="[
                [{html: '<a href=#>hello 1</a>'}, {html: 'hello 2'}],
                [{html: '<a href=#>hello 1</a>'}, {html: 'hello 2', primary: true}],
            ]"></table-component> -->

<template>
    <div>
        <div class="table-responsive table-hover">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th v-for="column in columns" :key="column">{{ column }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(row, index) in rows" :key="'row' + index">
                        <td
                            v-bind:class="{ 'text-primary': cell.primary }"
                            v-for="(cell, cell_index) in row"
                            v-html="cell.html"
                            :key="'cell' + index + cell_index"
                        ></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div v-if="pagination">
            <a class="button" href="#">Previous</a>
            <a class="button" href="#">Next</a>
        </div>
    </div>
</template>

<script>
export default {
    props: ['rows', 'columns', 'pagination'],
    data() {
        return {
            //columns: ['test 1', 'test 2'],
            // rows: [
            //     [{html: '<a href="#">hello 1</a>'}, {html: 'hello 2'}],
            //     [{html: '<a href="#">hello 1</a>'}, {html: 'hello 2', primary: true}],
            // ],
        };
    },
    mounted() {
        this.pushRow();
    },
    methods: {
        pushRow: function () {
            this.rows.push([{ html: '<a href="#">hello 1</a>' }]);
        },
    },
};
</script>
