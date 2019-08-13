<template>
    <canvas width=600 height=600 id="canvas" ref="canvas"></canvas>
</template>

<script>
export default {
    props: {
        xCellNum: {
            type: Number,
            default: 25,
        },
        yCellNum: {
            type: Number,
            default: 30,
        },
    },
    data () {
        return {
            marginX: 10,
            marginY: 10,
            cells: null,
        }
    },
    mounted() {
        this.initCells()
        // this.drawCells()

        this.$refs.canvas.addEventListener("click", e => {
            const rect = this.$refs.canvas.getBoundingClientRect();
            const point = {
                x: e.clientX - rect.left,
                y: e.clientY - rect.top
            };

            this.cells.forEach((cell, index) => {
                const hit =
                    (cell.x <= point.x && point.x <= cell.x + cell.w)
                    && (cell.y <= point.y && point.y <= cell.y + cell.h);
                if (hit) {
                    this.onCellClicked(index, cell)
                }
            });
        });
    },
    computed: {
        context () {
            return this.$el.getContext('2d');
        },
        cellSize () {
            const cellWidth = (this.$el.width - (this.marginX * 2)) / (this.xCellNum + this.leftSideHintAreaNum);
            const cellHeight = (this.$el.height - (this.marginY * 2)) / (this.yCellNum + this.upSideHintAreaNum);
            return Math.min(cellWidth, cellHeight);
        },
        upSideHintAreaNum () {
            return (this.yCellNum + this.yCellNum % 2) / 2;
        },
        leftSideHintAreaNum () {
            return (this.xCellNum + this.xCellNum % 2) / 2;
        },
        boardWidth () {
            return (this.cellSize * this.xCellNum) + (this.cellSize * this.leftSideHintAreaNum);
        },
        boardHeight () {
            return (this.cellSize * this.yCellNum) + (this.cellSize * this.upSideHintAreaNum);
        },
    },
    methods: {
        getVerticalCells (upSideNo) {
            return this.cells.filter(cell => cell.upSideNo === upSideNo);
        },
        getHorizontalCells (leftSideNo) {
            return this.cells.filter(cell => cell.leftSideNo === leftSideNo);
        },
        initCells () {
            const cells = [];
            for (let i = 0; i < this.xCellNum; i++) {
                const x = this.marginX + (this.leftSideHintAreaNum * this.cellSize) + (i * this.cellSize);
                for (let j = 0; j < this.yCellNum; j++) {
                    const y = this.marginY + (this.upSideHintAreaNum * this.cellSize) + (j * this.cellSize);
                    const cell = {
                        upSideNo: i,
                        leftSideNo: j,
                        x: x,
                        y: y,
                        w: this.cellSize,
                        h: this.cellSize,
                        state: 0,
                    };
                    cells.push(cell);
                }
            }
            this.cells = cells
        },
        onCellClicked (index, cell) {
            this.toggleCellState(index, cell);
        },
        draw () {
            this.context.clearRect(0, 0, this.marginX + this.boardWidth, this.marginY + this.boardHeight);

            this.drawFrame();

            this.cells.forEach(cell =>  {
                this.drawRect(cell);
            });
            this.drawHints()
        },
        drawFrame () {
            for (let i = 0; i < this.xCellNum + 1; i++) {
                if (i % 5 === 0) {
                    this.context.strokeStyle = "rgba(0, 0, 0, 0.8)";
                } else {
                    this.context.strokeStyle = "rgba(0, 0, 0, 0.4)";
                }
                this.strokeLine(this.marginX + (this.leftSideHintAreaNum * this.cellSize) + (i * this.cellSize), this.marginY, this.marginX + (this.leftSideHintAreaNum * this.cellSize) + (i * this.cellSize), this.marginY + this.boardHeight);
            }

            for (let i = 0; i < this.yCellNum + 1; i++) {
                if (i % 5 === 0) {
                    this.context.strokeStyle = "rgba(0, 0, 0, 0.8)";
                } else {
                    this.context.strokeStyle = "rgba(0, 0, 0, 0.4)";
                }
                this.strokeLine(this.marginX, this.marginY + (this.upSideHintAreaNum * this.cellSize) + (i * this.cellSize), this.marginX + this.boardWidth, this.marginY + (this.upSideHintAreaNum * this.cellSize) + (i * this.cellSize));
            }
        },
        drawHints () {
            const upSideHints = this.upSideHints()
            upSideHints.forEach((hint, index) => {
                for (let i = hint.length - 1; i >= 0; i--) {
                    const value = hint[i];
                    const x = this.marginX + (this.leftSideHintAreaNum * this.cellSize) + (index * this.cellSize) + (this.cellSize / 2) - 5;
                    const y = this.marginY + (this.upSideHintAreaNum * this.cellSize) - ((hint.length - 1) * this.cellSize) + (i * this.cellSize) - 5;
                    this.context.strokeText(value, x, y, this.cellSize)
                }
            });

            const leftSideHints = this.leftSideHints()
            leftSideHints.forEach((hint, index) => {
                for (let i = hint.length - 1; i >= 0; i--) {
                    const value = hint[i];
                    const x = this.marginX + (this.leftSideHintAreaNum * this.cellSize) - ((hint.length - 1) * this.cellSize) + (i * this.cellSize) - 15;
                    const y = this.marginY + (this.upSideHintAreaNum * this.cellSize) + (index * this.cellSize) + (this.cellSize / 2) + 2;
                    this.context.strokeText(value, x, y, this.cellSize)
                }
            });
        },
        strokeLine(x1, y1, x2, y2) {
            this.context.beginPath();
            this.context.moveTo(x1, y1);
            this.context.lineTo(x2, y2);
            this.context.stroke();
        },
        drawRect (rect) {
            this.context.fillStyle = "rgb(0, 0, 0, 0.9)";
            switch (rect.state) {
                case 0:
                    // this.context.strokeRect(rect.x, rect.y, rect.w, rect.h);
                    break;
                case 1:
                    this.context.fillRect(rect.x, rect.y, rect.w, rect.h);
                    break;
                default:
                    console.warn('unknown state:' + rect.state);
                    break;
            }
        },
        toggleCellState(index, cell) {
            const newCell = this.deepCopy(cell);
            newCell.state = (cell.state === 1) ? 0 : 1;
            this.$set(this.cells, index, newCell)
        },
        deepCopy (obj) {
            return JSON.parse(JSON.stringify(obj));
        },
        upSideHints () {
            const hints = [];
            for (let i = 0; i < this.xCellNum; i++) {
                const hint = [];
                const cells = this.getVerticalCells(i);

                let chainNum = 0;
                for (let j = 0; j < cells.length; j++) {
                    const cell = cells[j];
                    if (cell.state === 1) {
                        chainNum++;
                    }
                    if (cells[j + 1] && cells[j + 1].state === 1) {
                        continue;
                    }
                    if (chainNum === 0) {
                        continue;
                    }
                    hint.push(chainNum);
                    chainNum = 0
                }
                if (hint.length === 0) {
                    hint.push(0)
                }
                hints.push(hint);
            }
            return hints;
        },
        leftSideHints () {
            const hints = [];
            for (let i = 0; i < this.yCellNum; i++) {
                const hint = [];
                const cells = this.getHorizontalCells(i);

                let chainNum = 0;
                for (let j = 0; j < cells.length; j++) {
                    const cell = cells[j];
                    if (cell.state === 1) {
                        chainNum++;
                    }
                    if (cells[j + 1] && cells[j + 1].state === 1) {
                        continue;
                    }
                    if (chainNum === 0) {
                        continue;
                    }
                    hint.push(chainNum);
                    chainNum = 0
                }
                if (hint.length === 0) {
                    hint.push(0)
                }
                hints.push(hint);
            }
            return hints;
        },
    },
    watch: {
        cells: {
            handler () {
                this.draw();
            },
            deep: true,
        }
    }
}
</script>

<style scoped>
    #canvas {
        border: 1px solid #000;
        margin: 20px;
    }
</style>
