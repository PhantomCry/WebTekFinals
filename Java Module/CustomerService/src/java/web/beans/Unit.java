/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package web.beans;
import java.math.BigDecimal;

/**
 *
 * @author Earl
 */
public class Unit {

    public String unitId;
    public String condoName;
    public String desc;
    public String address;
    public int capacity;
    public int noOfBeds;
    public BigDecimal ratePerNight;
    public String vacancy;

    public String getUnitId() {
        return unitId;
    }

    public void setUnitId(String unitId) {
        this.unitId = unitId;
    }

    public String getCondoName() {
        return condoName;
    }

    public void setCondoName(String condoName) {
        this.condoName = condoName;
    }

    public String getDesc() {
        return desc;
    }

    public void setDesc(String desc) {
        this.desc = desc;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public int getCapacity() {
        return capacity;
    }

    public void setCapacity(int capacity) {
        this.capacity = capacity;
    }

    public int getNoOfBeds() {
        return noOfBeds;
    }

    public void setNoOfBeds(int noOfBeds) {
        this.noOfBeds = noOfBeds;
    }

    public BigDecimal getRatePerNight() {
        return ratePerNight;
    }

    public void setRatePerNight(BigDecimal ratePerNight) {
        this.ratePerNight = ratePerNight;
    }

    public String getVacancy() {
        return vacancy;
    }

    public void setVacancy(String vacancy) {
        this.vacancy = vacancy;
    }

    public Unit(String unitId, String condoName, String desc, String address, int capacity, int noOfBeds, BigDecimal ratePerNight, String vacancy) {
        this.unitId = unitId;
        this.condoName = condoName;
        this.desc = desc;
        this.address = address;
        this.capacity = capacity;
        this.noOfBeds = noOfBeds;
        this.ratePerNight = ratePerNight;
        this.vacancy = vacancy;
    }
}
