package com.revolve44.smartmonitor3.setcustomer


import android.annotation.SuppressLint
import android.content.Intent
import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Button
import android.widget.EditText
import androidx.fragment.app.Fragment
import com.google.android.material.snackbar.Snackbar
import com.revolve44.smartmonitor3.MainActivity
import com.revolve44.smartmonitor3.R

import kotlin.math.roundToInt

//import com.revolve44.windturbine1.R;
class SettingNominalPowerFragment : Fragment() {
    // Store instance variables
    var a = 0
    private var title: String? = null
    private var page = 0
    private var diam = 0
    private var nominalpow = 0
    //var rangeSeekbar: CrystalRangeSeekbar? = null
    // Store instance variables based on arguments passed
    @SuppressLint("UseRequireInsteadOfGet")
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        page = requireArguments().getInt("someInt2", 0)
        title = requireArguments().getString("someTitle2")
    }

    // Inflate the view for the fragment based on layout XML
    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        val view =
            inflater.inflate(R.layout.fragmentlocation_nominalpower, container, false)
        val diametrinput = view.findViewById<EditText>(R.id.rotord)
        val nominalinput = view.findViewById<EditText>(R.id.nominalpow)
        // get min and max text view
//        val tvMin = view.findViewById<View>(R.id.textMin1) as TextView
//        val tvMax = view.findViewById<View>(R.id.textMax1) as TextView
        val saveall =
            view.findViewById<Button>(R.id.tomainactiv)

        diametrinput.setText("")
        nominalinput.setText("")



//        saveall.setOnClickListener {
//            try {
//                diam = diametrinput.text.toString().toInt()
//                nominalpow = nominalinput.text.toString().toInt()
//
//            }catch (e: Exception){
//                //view?.let { Snackbar.make(it, "Please, fill all forms ", Snackbar.LENGTH_LONG).show() };
//
//            }
//
//
//            if ((diam > 0) and (nominalpow > 0)) {
////                AppPreferences.radius = diam/2f
////                AppPreferences.nominalPower = nominalpow.toFloat()
////                AppPreferences.firststart = false
//                val intent = Intent(activity, MainActivity::class.java)
//                startActivity(intent)
//            } else {
//
//                view?.let { Snackbar.make(it, "Please, fill all forms ", Snackbar.LENGTH_LONG).show() };
//            }
//        }
        return view
    }

    companion object {
        // newInstance constructor for creating fragment with arguments
        @JvmStatic
        fun newInstance(page: Int, title: String?): SettingNominalPowerFragment {
            val fragmentFirst = SettingNominalPowerFragment()
            val args = Bundle()
            args.putInt("someInt2", page)
            args.putString("someTitle2", title)
            fragmentFirst.arguments = args
            return fragmentFirst
        }
    }
}
