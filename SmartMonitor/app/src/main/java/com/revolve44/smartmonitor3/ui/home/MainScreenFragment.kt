package com.revolve44.smartmonitor3.ui.home

import android.annotation.SuppressLint
import android.app.AlertDialog
import android.content.DialogInterface
import android.content.Intent
import android.os.Bundle
import android.os.Handler
import android.view.Gravity
import android.view.View
import android.widget.TextView
import androidx.fragment.app.Fragment
import androidx.recyclerview.widget.GridLayoutManager
import androidx.recyclerview.widget.LinearLayoutManager
import com.revolve44.smartmonitor3.R
import com.revolve44.smartmonitor3.adapters.HomeAdapter
import com.revolve44.smartmonitor3.core.Router
import com.revolve44.smartmonitor3.network.Api
import com.revolve44.smartmonitor3.setcustomer.LocationActivity
import com.revolve44.smartmonitor3.storage.SharedPref
import com.revolve44.smartmonitor3.storage.Variables
import kotlinx.android.synthetic.main.fragment_home.*


class MainScreenFragment : Fragment(R.layout.fragment_home) {

    private lateinit var homeViewModel: HomeViewModel
    var router : Router = Router()
//    lateinit var alertIcon : ImageView
    var i : Int = 12
   // var myDevices = arrayOf("Polaris Kettle", "PC", "Refrigerator", "MP3 Center", "Tesla Charger", "Heater", "Fan", "Xiamomi brash")
    //var thisfragment : HomeFragment = HomeFragment()
    lateinit var mainDescription : TextView
    var api : Api = Api()
    var a = 0
    var variables : Variables = Variables()


    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)
        initRecyclerview()
        //final TickerView tickerView = findViewById(R.id.tickerView);
       // tickerView.setCharacterLists(TickerUtils.provideNumberList());
        mainDescription = view.findViewById(R.id.textdescription)

        showDescription()
        val handler = Handler()
        handler.postDelayed({
            // do something after 1000ms
            runTwoIndicators()
        }, 2000)



        twoIndicators.setOnClickListener {
            api.startRequest()
            switchDescription()
        }
        maps.setOnClickListener {
            val intent = Intent(activity, LocationActivity::class.java)
            startActivity(intent)
        }
        alertX.setOnClickListener {
            val alertDialog: AlertDialog = AlertDialog.Builder(activity).create()
            alertDialog.setTitle("Уведомления")
            alertDialog.setMessage("Аномалий не обнаружено!")
            alertDialog.setButton(AlertDialog.BUTTON_NEUTRAL, "OK, спасибо",
                DialogInterface.OnClickListener { dialog, which -> dialog.dismiss() })

//            alertDialog.setButton(AlertDialog.BUTTON_POSITIVE, "Don't show again",
//                DialogInterface.OnClickListener { dialog, which ->
//                    editor.putBoolean("showagain", false)
//                    editor.apply()
//                    dialog.dismiss()
//                })
            alertDialog.show()
        }


        //var tview : TickerView = ₽/час
        //var alertIcon : Int = R.id.alertIcon
        //alert()

    }

    private fun initRecyclerview() {
        recyler.apply {
            layoutManager = LinearLayoutManager(activity)
            layoutManager = GridLayoutManager(activity, 2)
            adapter = HomeAdapter(router.arrayHolder(), router.arrayPowerConsume())

        }

    }

    @SuppressLint("SetTextI18n")
    fun showDescription(){

        mainDescription.text = "Smart Monitor"
        val handler = Handler()
        handler.postDelayed({
            // do something after 1000ms
            mainDescription.text = "за час вы тратите:"
        }, 4000)
    }

    fun switchDescription(){
//        if (a!=0){
//            a++
//        }


        when (a) {
            0 -> {
                mainDescription.text = "за час вы тратите:"
                runTwoIndicators()
                a++
            }
            1 -> {
                mainDescription.text = "за день вы потратите:"
                runTwoIndicators()
                a++
            }
            2 -> {
                mainDescription.text = "за месяц вы потратите:"
                runTwoIndicators()
                a++
            }
        }
//        if (a==0){
//            a++
//        }

        if (a>=3){ a = 0 }


    }

    fun runTwoIndicators(){
        when (a) {
            0 -> {
                try {
                    tickerView.gravity = Gravity.CENTER
                    tickerView.setText("" + SharedPref.getPowerHour(activity) + "", true)

                    tickerView2.gravity = Gravity.CENTER
                    tickerView2.setText("" + SharedPref.getRubHour(activity) + "", true)
                } catch (e: Exception) {

                }

            }
            1 -> {
                tickerView.gravity = Gravity.CENTER
                tickerView.setText("9.4", true)

                tickerView2.gravity = Gravity.CENTER
                tickerView2.setText("807", true)
            }
            2 -> {
                tickerView.gravity = Gravity.CENTER
                tickerView.setText("350.6 ", true)

                tickerView2.gravity = Gravity.CENTER
                tickerView2.setText("10256", true)
            }
        }
//        tickerView.gravity = Gravity.CENTER
//        tickerView.setText("$i ",true)
//
//        tickerView2.gravity = Gravity.CENTER
//        tickerView2.setText("1.2",true)
    }

//    fun resetGray(): ColorMatrixColorFilter {
//        val matrix = ColorMatrix()
//        matrix.setSaturation(1f)
//        val filter = ColorMatrixColorFilter(matrix)
//        return filter
//    }
}