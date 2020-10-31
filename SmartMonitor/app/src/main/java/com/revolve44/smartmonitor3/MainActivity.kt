package com.revolve44.smartmonitor3


import android.content.Intent
import android.os.Bundle
import android.view.View
import androidx.appcompat.app.AppCompatActivity
import androidx.fragment.app.Fragment
import com.google.android.material.bottomnavigation.BottomNavigationView
import com.revolve44.smartmonitor3.network.Api
import com.revolve44.smartmonitor3.network.LaunchPadRetrofit
import com.revolve44.smartmonitor3.network.TmdbEndpoints
import com.revolve44.smartmonitor3.setcustomer.LocationActivity
import com.revolve44.smartmonitor3.storage.SharedPref
import com.revolve44.smartmonitor3.ui.dashboard.PieStatisticsFragment
import com.revolve44.smartmonitor3.ui.home.MainScreenFragment
import com.revolve44.smartmonitor3.ui.notifications.NotificationsFragment


class MainActivity : AppCompatActivity() {

    val fragment1: Fragment = MainScreenFragment()
    val fragment2: Fragment = PieStatisticsFragment()
    val fragment3: Fragment = NotificationsFragment()
    val fm = supportFragmentManager
    var active = fragment1
    //lateinit var toolbar : Toolbar
    val launchReuest : LaunchPadRetrofit = LaunchPadRetrofit()

    lateinit var tmdbEndpoints: TmdbEndpoints

    var api : Api = Api()




    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)
        SharedPref.initPreferences(this);// send context to method in class SharedPref
       api.startRequest()

        //launchReuest.apilaunch()

        val navView: BottomNavigationView = findViewById(R.id.nav_view)
        val navigation =
            findViewById<View>(R.id.nav_view) as BottomNavigationView
        navigation.setOnNavigationItemSelectedListener(mOnNavigationItemSelectedListener)
        //I added this if statement to keep the selected fragment when rotating the device
        //I added this if statement to keep the selected fragment when rotating the device
        if (savedInstanceState == null) {
            supportFragmentManager.beginTransaction().replace(
                R.id.nav_host_fragment,
                MainScreenFragment()
            ).addToBackStack(null).commit()
        }


        //open and .hide fragment in one moment
        fm.beginTransaction().add(R.id.nav_host_fragment, fragment2, "2").hide(fragment2).commit()
        fm.beginTransaction().add(R.id.nav_host_fragment, fragment3, "3").hide(fragment3).commit()
        fm.beginTransaction().add(R.id.nav_host_fragment, fragment1, "1").commit()



    }



    //switcher of fragmnets, he help for switching without loss filled form in fragments
    private val mOnNavigationItemSelectedListener =
        BottomNavigationView.OnNavigationItemSelectedListener { item ->
            when (item.itemId) {
                R.id.navigation_home -> {

                    fm.beginTransaction().hide(active).show(fragment1).commit()
                    active = fragment1
                    return@OnNavigationItemSelectedListener true
                }
                R.id.navigation_dashboard -> {

                    fm.beginTransaction().hide(active).show(fragment2).commit()
                    active = fragment2
                    return@OnNavigationItemSelectedListener true
                }
                R.id.navigation_notifications -> {

                    fm.beginTransaction().hide(active).show(fragment3).commit()
                    active = fragment3
                    return@OnNavigationItemSelectedListener true
                }

            }
            false
        }



}