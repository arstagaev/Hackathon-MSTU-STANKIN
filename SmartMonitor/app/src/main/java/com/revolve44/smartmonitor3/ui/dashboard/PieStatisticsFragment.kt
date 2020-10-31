package com.revolve44.smartmonitor3.ui.dashboard

import android.graphics.Color
import android.os.Bundle
import android.os.Handler
import android.util.Log
import android.view.View
import android.widget.AdapterView
import android.widget.ArrayAdapter
import android.widget.ListView
import android.widget.Spinner
import androidx.fragment.app.Fragment
import com.github.mikephil.charting.charts.PieChart
import com.github.mikephil.charting.data.PieData
import com.github.mikephil.charting.data.PieDataSet
import com.github.mikephil.charting.data.PieEntry
import com.revolve44.smartmonitor3.R
import com.revolve44.smartmonitor3.constants.arrayx
import com.revolve44.smartmonitor3.constants.colorGrey
import com.revolve44.smartmonitor3.constants.ioi
import com.revolve44.smartmonitor3.core.DemoDataGenerator
import com.revolve44.smartmonitor3.core.Router
import kotlinx.android.synthetic.main.fragment_piestat.*
import okhttp3.Route
import java.util.*
import kotlin.collections.HashMap


class PieStatisticsFragment : Fragment(R.layout.fragment_piestat) {

    //private lateinit var dashboardViewModel: DashboardViewModel
    var router : Router = Router()

    var list = arrayOf(1f, 23f, 435f, 45f, 233f)
    var hm : HashMap<Int, String> = HashMap()
    var ArrayofDevice : ArrayList<String> = ArrayList()
    private lateinit var listView : ListView
    lateinit var spinner : Spinner
    lateinit var chart : PieChart
    var demogen : DemoDataGenerator = DemoDataGenerator()
    var selectedMonth : Int = 1

    private val MyColors = intArrayOf(
        Color.rgb(255, 115, 0),
        Color.rgb(255, 236, 1),
        Color.rgb(215, 243, 11),
        Color.rgb(82, 215, 38),
        Color.rgb(27, 169, 47),
        Color.rgb(45, 203, 118),
        Color.rgb(36, 215, 173),
        Color.rgb(119, 221, 223),
        Color.rgb(0, 127, 211)
    )

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)
        listView = view.findViewById<ListView>(R.id.recipe_list_view)
        spinner = view.findViewById(R.id.spinner) as Spinner
        chart = view.findViewById(R.id.piechartXML) as PieChart



        fillArrayOfDevice()

        pieChartSetup()
        spinnerSetup()




        val arrayAdapter : ArrayAdapter<String> = ArrayAdapter<String>(requireContext(),android.R.layout.simple_list_item_1, ArrayofDevice )
        listView.adapter = arrayAdapter

    }

    private fun spinnerSetup() {

        // Spinner element

        // Spinner element
        //val values = arrayOf("$", "€", "₽")

        val adapter: ArrayAdapter<String> = ArrayAdapter<String>(requireContext(), android.R.layout.simple_spinner_item, arrayx)
        adapter.setDropDownViewResource(android.R.layout.simple_dropdown_item_1line)
        spinner.adapter = adapter

        spinner.onItemSelectedListener = object: AdapterView.OnItemSelectedListener {
            override fun onNothingSelected(parent: AdapterView<*>?) {


            }

            override fun onItemSelected(
                parent: AdapterView<*>?,
                view: View?,
                position: Int,
                id: Long
            ) {
                selectedMonth = position
                val handler = Handler()
                handler.postDelayed({
                    // do something after 1000ms
                    pieChartSetup()
                    piechartXML.invalidate()
                }, 1000)

                Log.d("Selected Motnth", " $position")

            }
        }
    }


    private fun pieChartSetup(){


        //Create a dataset
        val dataArray = ArrayList<PieEntry>()
        //var iterator : Int = 0
        //selectedMonth = 1
        for (io  in 1 .. router.arrayHolder().size-1){

            when (selectedMonth){
                1,3,5,7,9 -> dataArray.add(PieEntry(demogen.firstArray().get(io),router.arrayHolder().get(io)))
                2,6,11 -> dataArray.add(PieEntry(demogen.secondArray().get(io),router.arrayHolder().get(io)))
                8,10,12 -> dataArray.add(PieEntry(demogen.thirdArray().get(io),router.arrayHolder().get(io)))
            }


            //iterator++
        }
        //iterator= 1
//        dataArray.add(PieEntry(38f,""))
//        dataArray.add(PieEntry(14f))
//        dataArray.add(PieEntry(14f))
//        dataArray.add(PieEntry(34f))


        val dataSet = PieDataSet(dataArray, "")
        dataSet.valueTextSize=15f
        dataSet.valueTextColor=Color.BLACK
        //dataSet.valueLineColor = Color.BLACK
        dataSet.color = Color.BLUE
        dataSet.setColor(Color.rgb(0, 0, 0))



        //Color set for the chart
        val colorSet = java.util.ArrayList<Int>()
        colorSet.add(Color.rgb(85, 0, 255))  //идгу
        colorSet.add(Color.rgb(255, 0, 144))  // blue
        colorSet.add(Color.GREEN)  // green
        colorSet.add(Color.rgb(255, 238, 0))  // Yellow
        colorSet.add(Color.rgb(132, 255, 0))  // Yellow


        dataSet.setColors(colorSet)

        val data = PieData(dataSet)


        //chart description
        piechartXML.description.text = "Доли в кВт*ч"
        piechartXML.description.yOffset = 5f

        piechartXML.description.textSize = 20f
        piechartXML.description.textColor = Color.BLACK
        //Chart data and other styling
        piechartXML.data = data
        piechartXML.centerTextRadiusPercent = 0f
        piechartXML.setHoleColor(Color.parseColor(colorGrey))

        piechartXML.isDrawHoleEnabled = true
        piechartXML.legend.isEnabled = false
        piechartXML.description.isEnabled = true

    }

    private fun fillArrayOfDevice(){


        ArrayofDevice.add("Вы сэкономили на $ioi рублей больше чем в прошлом месяце")
        ArrayofDevice.add("Самый прожорливый прибор: ${router.arrayHolder().get(3)}")
        ArrayofDevice.add("Самое экономное потребление: ${router.arrayHolder().get(0)} ")
        ArrayofDevice.add("Вы экономите лучше чем 93% наших пользователей")

    }



}