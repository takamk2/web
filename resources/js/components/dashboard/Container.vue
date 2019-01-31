<template>
    <div class="container">
        <button @click="showModal">show modal</button>
        <ul>
            <li><a href="/locations">Locations</a></li>
            <li><a href="/todos">Todos</a></li>
            <li><a href="/healths">Healths</a></li>
        </ul>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        data() {
            return {
                // グラフ描画用データ
                pieChartData: {
                    // ラベル
                    labels: ["天領", "薩摩", "長州", "土佐"],
                    // データ詳細
                    datasets: [{
                        label: '藩と人口',
                        data: [13740000, 9072000, 7150000, 6148000],
                        backgroundColor: [
                            'rgba(255, 100, 130, 0.2)',
                            'rgba(100, 130, 255, 0.2)',
                            'rgba(130, 255, 100, 0.2)',
                            'rgba(230, 210, 85, 0.2)'
                        ]
                    }]
                },
                // グラフオプション
                options: {
                    title: {
                        display: true,
                        text: '藩と人口'
                    },
                }
            }
        },
        mounted () {
            console.log('mounted')
        },
        methods: {
            showModal () {
                this.$modal.show({
                    template: `
    <div>
      <h1>This is created inline</h1>
      <p>{{ text }}</p>
    </div>
  `,
                    props: ['text']
                }, {
                    text: 'This text is passed as a property'
                }, {
                    height: 'auto'
                }, {
                    'before-close': (event) => { console.log('this will be called before the modal closes'); }
                })
            },
        }
    }
</script>

<style lang="scss" scoped>
</style>
