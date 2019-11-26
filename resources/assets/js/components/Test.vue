<template>
    <div class="example-placeholder"  style="height: 720px; padding-top: 0;"></div>
</template>

<script>
    export default {
        data: () => ({
            columns: [],
            data: [],
            total: 0,
            query: {}
        }),
        mounted() {
            this.getTableHeader();
        },
        methods: {
            getTableHeader() {
                var config = {
                    "locale": {
                        "filePath": "https://s3-eu-west-1.amazonaws.com/static.gapminderdev.org/assets/translation/"
                    },
                    "data": {
                        "reader": "csv",
                        //"reader": "csv-time_in_columns",
                        "path": "/data/long_N_bubble23.csv"
                        //"path": "https://raw.githubusercontent.com/Gapminder/vizabi-website/develop/data/UN-migrant-stock-data-exported.csv"
                    }
                };
                Vizabi("BubbleChart", document.getElementById("test2"), config);
            }
        }
    }
</script>