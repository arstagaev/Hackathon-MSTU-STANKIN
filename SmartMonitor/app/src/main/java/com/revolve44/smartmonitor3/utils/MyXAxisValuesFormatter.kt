package com.revolve44.smartmonitor3.utils


import  com.github.mikephil.charting.components.AxisBase
import com.github.mikephil.charting.formatter.IAxisValueFormatter

class MyXAxisValuesFormatter : IAxisValueFormatter {
    private var values : Array<String>

    constructor(values: Array<String>){
        this.values = values
    }
    override fun getFormattedValue(value: Float, axis: AxisBase?): String {
        return values[value.toInt()]
    }
}