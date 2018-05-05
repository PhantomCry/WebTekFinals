/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package web.beans;

/**
 *
 * @author Earl
 */
public class Home {

    public String homeId;
    public String name;
    public String category;
    public String address;
    public short homeNo;
    public int capacity;
    public int noOfRooms;
    public int noOfBeds;
    public int ratePerNight;
    public String amenities;

    public Home(String homeId, String name, String category, String address, short homeNo,
            int capacity, int noOfRooms, int noOfBeds, int ratePerNight, String amenities) {
        this.homeId = name;
        this.name = name;
        this.category = category;
        this.address = address;
        this.homeNo = homeNo;
        this.capacity = capacity;
        this.noOfRooms = noOfRooms;
        this.noOfBeds = noOfBeds;
        this.ratePerNight = ratePerNight;
        this.amenities = amenities;
    }
    
    public String getHomeId() {
        return homeId;
    }
    
    public String setHomeId(String homeId){
        return homeId;
    }
    
    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getCategory() {
        return category;
    }

    public void setCategory(String category) {
        this.category = category;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public short getHomeNo() {
        return homeNo;
    }

    public void setHomeNo(short homeNo) {
        this.homeNo = homeNo;
    }

    public int getCapacity() {
        return capacity;
    }

    public void setCapacity(int capacity) {
        this.capacity = capacity;
    }

    public int getNoOfRooms() {
        return noOfRooms;
    }

    public void setNoOfRooms(int noOfRooms) {
        this.noOfRooms = noOfRooms;
    }

    public int getNoOfBeds() {
        return noOfBeds;
    }

    public void setNoOfBeds(int noOfBeds) {
        this.noOfBeds = noOfBeds;
    }

    public int getRatePerNight() {
        return ratePerNight;
    }

    public void setRatePerNight(int ratePerNight) {
        this.ratePerNight = ratePerNight;
    }

    public String getAmenities() {
        return amenities;
    }

    public void setAmenities(String amenities) {
        this.amenities = amenities;
    }

}
