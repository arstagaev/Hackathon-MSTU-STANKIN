package com.revolve44.smartmonitor3.adapters

import android.annotation.SuppressLint
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView
import com.revolve44.smartmonitor3.R
import java.util.ArrayList


class HomeAdapter(var myDevices: ArrayList<String>, var PowerConsumeofDevices : ArrayList<Float>) : RecyclerView.Adapter<HomeAdapter.ViewHolder>() {


//    //lateinit var HomeFragment : fragment
//    open interface PlayPauseClick {
//        fun imageButtonOnClick(v: View?, position: Int)
//    }
//
//    private var callback: PlayPauseClick? = null
//
//    fun setPlayPauseClickListener(listener: PlayPauseClick?) {
//        callback = listener
//    }

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): HomeAdapter.ViewHolder {
        val view = LayoutInflater.from(parent.context).inflate(
            R.layout.row_on_main_page,
            parent,
            false
        )
        return ViewHolder(view)
    }

    @SuppressLint("SetTextI18n")
    override fun onBindViewHolder(holder: HomeAdapter.ViewHolder, position: Int) {
        holder.deviceid.setText(myDevices.get(position))
        holder.consumePowerbyDevice.setText("~"+PowerConsumeofDevices.get(position)+" кВт")

//        holder.playPause.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View v) {
//
//                if (callback != null) {
//                    callback.imageButtonOnClick(v, position);
//                }
//            }
//        }


    }
    //override fun getItemCount() = 30 // change in futu

    override fun getItemCount(): Int {
        return myDevices.size
    }

      class ViewHolder(itemView: View) : RecyclerView.ViewHolder(itemView),
       View.OnClickListener {
          val deviceid: TextView = itemView.findViewById<View>(R.id.deviceID) as TextView
          val consumePowerbyDevice: TextView = itemView.findViewById<View>(R.id.powerConsume) as TextView
          init {
              itemView.setOnClickListener(this)

              //cardView.setCardBackgroundColor(Color.RED);
          }

          override fun onClick(p0: View?) {
//        if (callback != null) {
//            callback.imageButtonOnClick(v, position);
//        }


          }
      }
}