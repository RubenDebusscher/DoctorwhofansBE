KB.component('chart-project-analytics-time-comparison', function (containerElement, options) {
    this.render = function () {
        let spent = options.labelSpent;
        let estimated = options.labelEstimated;
        let data = [];
        let result = [];
        let groupsSpent = [];
        let groupsEstimated = [];
        let categories = [options.labelOpen, options.labelClosed];

        for (let metric in options.metrics) {
            data[metric+'-'+spent] = [metric+'-'+spent];
            data[metric+'-'+estimated] = [metric+'-'+estimated];
            groupsSpent.push(metric+'-'+spent);
            groupsEstimated.push(metric+'-'+estimated);
            data[metric+'-'+spent].push(options.metrics[metric]['open'].time_spent);
            data[metric+'-'+estimated].push(options.metrics[metric]['open'].time_estimated);
            data[metric+'-'+spent].push(options.metrics[metric]['closed'].time_spent);
            data[metric+'-'+estimated].push(options.metrics[metric]['closed'].time_estimated);
            result.push(data[metric+'-'+estimated]);
            result.push(data[metric+'-'+spent]);
        }
        result.sort();

        KB.dom(containerElement).add(KB.dom('div').attr('id', 'chart').build());

        c3.generate({
            data: {
                columns: result,
                type: 'bar',
                groups: [
                    groupsEstimated,
                    groupsSpent
                ]
            },
            bar: {
                width: {
                    ratio: 0.5
                }
            },
            axis: {
                x: {
                    type: 'category',
                    categories: categories
                }
            },
            legend: {
                show: true
            }
        });
    };
});

KB.component('chart-project-analytics-spent-time-by-dates', function (containerElement, options) {
    this.render = function () {
        let spentTime = [options.labelSpent];
        spentTime.push(options.metrics['open']);
        spentTime.push(options.metrics['closed']);
        let categories = [options.labelOpen, options.labelClosed];

        KB.dom(containerElement).add(KB.dom('div').attr('id', 'chart').build());

        c3.generate({
            data: {
                columns: [spentTime],
                type: 'bar'
            },
            bar: {
                width: {
                    ratio: 0.3
                }
            },
            axis: {
                x: {
                    type: 'category',
                    categories: categories
                }
            },
            legend: {
                show: true
            }
        });
    };
});