<?php

namespace Sabre\VObject;

use DateTime;
use DateTimeZone;

class RecurrenceIteratorTest extends \PHPUnit_Framework_TestCase {

    function testValues() {

        $ev = new Component('VEVENT');
        $ev->UID = 'bla';
        $ev->RRULE = 'FREQ=DAILY;BYHOUR=10;BYMINUTE=5;BYSECOND=16;BYWEEKNO=32;BYYEARDAY=100,200';
        $dtStart = new Property\DateTime('DTSTART');
        $dtStart->setDateTime(new DateTime('2011-10-07'),Property\DateTime::UTC);

        $ev->add($dtStart);

        $vcal = Component::create('VCALENDAR');
        $vcal->add($ev);

        $it = new RecurrenceIterator($vcal,(string)$ev->uid);

        $this->assertTrue($it->isInfinite());
        $this->assertEquals(array(10), $it->byHour);
        $this->assertEquals(array(5), $it->byMinute);
        $this->assertEquals(array(16), $it->bySecond);
        $this->assertEquals(array(32), $it->byWeekNo);
        $this->assertEquals(array(100,200), $it->byYearDay);

    }

    /**
     * @expectedException InvalidArgumentException
     * @depends testValues
     */
    function testInvalidFreq() {

        $ev = new Component('VEVENT');
        $ev->RRULE = 'FREQ=SMONTHLY;INTERVAL=3;UNTIL=20111025T000000Z';
        $dtStart = new Property\DateTime('DTSTART');
        $dtStart->setDateTime(new DateTime('2011-10-07'),Property\DateTime::UTC);

        $ev->add($dtStart);

        $vcal = Component::create('VCALENDAR');
        $vcal->add($ev);

        $it = new RecurrenceIterator($vcal,(string)$ev->uid);

    }

    /**
     * @expectedException InvalidArgumentException
     */
    function testVCalendarNoUID() {

        $vcal = new Component('VCALENDAR');
        $it = new RecurrenceIterator($vcal);

    }

    /**
     * @expectedException InvalidArgumentException
     */
    function testVCalendarInvalidUID() {

        $vcal = new Component('VCALENDAR');
        $it = new RecurrenceIterator($vcal,'foo');

    }

    /**
     * @depends testValues
     */
    function testDaily() {

        $ev = new Component('VEVENT');
        $ev->UID = 'bla';
        $ev->RRULE = 'FREQ=DAILY;INTERVAL=3;UNTIL=20111025T000000Z';
        $dtStart = new Property\DateTime('DTSTART');
        $dtStart->setDateTime(new DateTime('2011-10-07', new DateTimeZone('UTC')),Property\DateTime::UTC);

        $ev->add($dtStart);

        $vcal = Component::create('VCALENDAR');
        $vcal->add($ev);

        $it = new RecurrenceIterator($vcal,$ev->uid);

        $this->assertEquals('daily', $it->frequency);
        $this->assertEquals(3, $it->interval);
        $this->assertEquals(new DateTime('2011-10-25', new DateTimeZone('UTC')), $it->until);

        // Max is to prevent overflow
        $max = 12;
        $result = array();
        foreach($it as $item) {

            $result[] = $item;
            $max--;

            if (!$max) break;

        }

        $tz = new DateTimeZone('UTC');

        $this->assertEquals(
            array(
                new DateTime('2011-10-07', $tz),
                new DateTime('2011-10-10', $tz),
                new DateTime('2011-10-13', $tz),
                new DateTime('2011-10-16', $tz),
                new DateTime('2011-10-19', $tz),
                new DateTime('2011-10-22', $tz),
                new DateTime('2011-10-25', $tz),
            ),
            $result
        );

    }

    /**
     * @depends testValues
     */
    function testNoRRULE() {

        $ev = new Component('VEVENT');
        $ev->UID = 'bla';
        $dtStart = new Property\DateTime('DTSTART');
        $dtStart->setDateTime(new DateTime('2011-10-07', new DateTimeZone('UTC')),Property\DateTime::UTC);

        $ev->add($dtStart);

        $vcal = Component::create('VCALENDAR');
        $vcal->add($ev);

        $it = new RecurrenceIterator($vcal,$ev->uid);

        $this->assertEquals('daily', $it->frequency);
        $this->assertEquals(1, $it->interval);

        // Max is to prevent overflow
        $max = 12;
        $result = array();
        foreach($it as $item) {

            $result[] = $item;
            $max--;

            if (!$max) break;

        }

        $tz = new DateTimeZone('UTC');

        $this->assertEquals(
            array(
                new DateTime('2011-10-07', $tz),
            ),
            $result
        );

    }

    /**
     * @depends testValues
     */
    function testDailyByDay() {

        $ev = new Component('VEVENT');
        $ev->UID = 'bla';
        $ev->RRULE = 'FREQ=DAILY;INTERVAL=2;BYDAY=TU,WE,FR';
        $dtStart = new Property\DateTime('DTSTART');
        $dtStart->setDateTime(new DateTime('2011-10-07', new DateTimeZone('UTC')),Property\DateTime::UTC);

        $ev->add($dtStart);

        $vcal = Component::create('VCALENDAR');
        $vcal->add($ev);

        $it = new RecurrenceIterator($vcal,(string)$ev->uid);

        $this->assertEquals('daily', $it->frequency);
        $this->assertEquals(2, $it->interval);
        $this->assertEquals(array('TU','WE','FR'), $it->byDay);

        // Grabbing the next 12 items
        $max = 12;
        $result = array();
        foreach($it as $item) {

            $result[] = $item;
            $max--;

            if (!$max) break;

        }

        $tz = new DateTimeZone('UTC');

        $this->assertEquals(
            array(
                new DateTime('2011-10-07', $tz),
                new DateTime('2011-10-11', $tz),
                new DateTime('2011-10-19', $tz),
                new DateTime('2011-10-21', $tz),
                new DateTime('2011-10-25', $tz),
                new DateTime('2011-11-02', $tz),
                new DateTime('2011-11-04', $tz),
                new DateTime('2011-11-08', $tz),
                new DateTime('2011-11-16', $tz),
                new DateTime('2011-11-18', $tz),
                new DateTime('2011-11-22', $tz),
                new DateTime('2011-11-30', $tz),
            ),
            $result
        );

    }

    /**
     * @depends testValues
     */
    function testWeekly() {

        $ev = new Component('VEVENT');
        $ev->UID = 'bla';
        $ev->RRULE = 'FREQ=WEEKLY;INTERVAL=2;COUNT=10';
        $dtStart = new Property\DateTime('DTSTART');
        $dtStart->setDateTime(new DateTime('2011-10-07', new DateTimeZone('UTC')),Property\DateTime::UTC);

        $ev->add($dtStart);

        $vcal = Component::create('VCALENDAR');
        $vcal->add($ev);

        $it = new RecurrenceIterator($vcal,(string)$ev->uid);

        $this->assertEquals('weekly', $it->frequency);
        $this->assertEquals(2, $it->interval);
        $this->assertEquals(10, $it->count);

        // Max is to prevent overflow
        $max = 12;
        $result = array();
        foreach($it as $item) {

            $result[] = $item;
            $max--;

            if (!$max) break;

        }

        $tz = new DateTimeZone('UTC');

        $this->assertEquals(
            array(
                new DateTime('2011-10-07', $tz),
                new DateTime('2011-10-21', $tz),
                new DateTime('2011-11-04', $tz),
                new DateTime('2011-11-18', $tz),
                new DateTime('2011-12-02', $tz),
                new DateTime('2011-12-16', $tz),
                new DateTime('2011-12-30', $tz),
                new DateTime('2012-01-13', $tz),
                new DateTime('2012-01-27', $tz),
                new DateTime('2012-02-10', $tz),
            ),
            $result
        );

    }

    /**
     * @depends testValues
     */
    function testWeeklyByDay() {

        $ev = new Component('VEVENT');
        $ev->UID = 'bla';
        $ev->RRULE = 'FREQ=WEEKLY;INTERVAL=2;BYDAY=TU,WE,FR;WKST=SU';
        $dtStart = new Property\DateTime('DTSTART');
        $dtStart->setDateTime(new DateTime('2011-10-07', new DateTimeZone('UTC')),Property\DateTime::UTC);

        $ev->add($dtStart);

        $vcal = Component::create('VCALENDAR');
        $vcal->add($ev);

        $it = new RecurrenceIterator($vcal,(string)$ev->uid);

        $this->assertEquals('weekly', $it->frequency);
        $this->assertEquals(2, $it->interval);
        $this->assertEquals(array('TU','WE','FR'), $it->byDay);
        $this->assertEquals('SU', $it->weekStart);

        // Grabbing the next 12 items
        $max = 12;
        $result = array();
        foreach($it as $item) {

            $result[] = $item;
            $max--;

            if (!$max) break;

        }

        $tz = new DateTimeZone('UTC');

        $this->assertEquals(
            array(
                new DateTime('2011-10-07', $tz),
                new DateTime('2011-10-18', $tz),
                new DateTime('2011-10-19', $tz),
                new DateTime('2011-10-21', $tz),
                new DateTime('2011-11-01', $tz),
                new DateTime('2011-11-02', $tz),
                new DateTime('2011-11-04', $tz),
                new DateTime('2011-11-15', $tz),
                new DateTime('2011-11-16', $tz),
                new DateTime('2011-11-18', $tz),
                new DateTime('2011-11-29', $tz),
                new DateTime('2011-11-30', $tz),
            ),
            $result
        );

    }

    /**
     * @depends testValues
     */
    function testMonthly() {

        $ev = new Component('VEVENT');
        $ev->UID = 'bla';
        $ev->RRULE = 'FREQ=MONTHLY;INTERVAL=3;COUNT=5';
        $dtStart = new Property\DateTime('DTSTART');
        $dtStart->setDateTime(new DateTime('2011-12-05', new DateTimeZone('UTC')),Property\DateTime::UTC);

        $ev->add($dtStart);

        $vcal = Component::create('VCALENDAR');
        $vcal->add($ev);

        $it = new RecurrenceIterator($vcal,(string)$ev->uid);

        $this->assertEquals('monthly', $it->frequency);
        $this->assertEquals(3, $it->interval);
        $this->assertEquals(5, $it->count);

        $max = 14;
        $result = array();
        foreach($it as $item) {

            $result[] = $item;
            $max--;

            if (!$max) break;

        }

        $tz = new DateTimeZone('UTC');

        $this->assertEquals(
            array(
                new DateTime('2011-12-05', $tz),
                new DateTime('2012-03-05', $tz),
                new DateTime('2012-06-05', $tz),
                new DateTime('2012-09-05', $tz),
                new DateTime('2012-12-05', $tz),
            ),
            $result
        );


    }

    /**
     * @depends testValues
     */
    function testMonthlyEndOfMonth() {

        $ev = new Component('VEVENT');
        $ev->UID = 'bla';
        $ev->RRULE = 'FREQ=MONTHLY;INTERVAL=2;COUNT=12';
        $dtStart = new Property\DateTime('DTSTART');
        $dtStart->setDateTime(new DateTime('2011-12-31', new DateTimeZone('UTC')),Property\DateTime::UTC);

        $ev->add($dtStart);

        $vcal = Component::create('VCALENDAR');
        $vcal->add($ev);

        $it = new RecurrenceIterator($vcal,(string)$ev->uid);

        $this->assertEquals('monthly', $it->frequency);
        $this->assertEquals(2, $it->interval);
        $this->assertEquals(12, $it->count);

        $max = 14;
        $result = array();
        foreach($it as $item) {

            $result[] = $item;
            $max--;

            if (!$max) break;

        }

        $tz = new DateTimeZone('UTC');

        $this->assertEquals(
            array(
                new DateTime('2011-12-31', $tz),
                new DateTime('2012-08-31', $tz),
                new DateTime('2012-10-31', $tz),
                new DateTime('2012-12-31', $tz),
                new DateTime('2013-08-31', $tz),
                new DateTime('2013-10-31', $tz),
                new DateTime('2013-12-31', $tz),
                new DateTime('2014-08-31', $tz),
                new DateTime('2014-10-31', $tz),
                new DateTime('2014-12-31', $tz),
                new DateTime('2015-08-31', $tz),
                new DateTime('2015-10-31', $tz),
            ),
            $result
        );


    }

    /**
     * @depends testValues
     */
    function testMonthlyByMonthDay() {

        $ev = new Component('VEVENT');
        $ev->UID = 'bla';
        $ev->RRULE = 'FREQ=MONTHLY;INTERVAL=5;COUNT=9;BYMONTHDAY=1,31,-7';
        $dtStart = new Property\DateTime('DTSTART');
        $dtStart->setDateTime(new DateTime('2011-01-01', new DateTimeZone('UTC')),Property\DateTime::UTC);

        $ev->add($dtStart);

        $vcal = Component::create('VCALENDAR');
        $vcal->add($ev);

        $it = new RecurrenceIterator($vcal,(string)$ev->uid);

        $this->assertEquals('monthly', $it->frequency);
        $this->assertEquals(5, $it->interval);
        $this->assertEquals(9, $it->count);
        $this->assertEquals(array(1, 31, -7), $it->byMonthDay);

        $max = 14;
        $result = array();
        foreach($it as $item) {

            $result[] = $item;
            $max--;

            if (!$max) break;

        }

        $tz = new DateTimeZone('UTC');

        $this->assertEquals(
            array(
                new DateTime('2011-01-01', $tz),
                new DateTime('2011-01-25', $tz),
                new DateTime('2011-01-31', $tz),
                new DateTime('2011-06-01', $tz),
                new DateTime('2011-06-24', $tz),
                new DateTime('2011-11-01', $tz),
                new DateTime('2011-11-24', $tz),
                new DateTime('2012-04-01', $tz),
                new DateTime('2012-04-24', $tz),
            ),
            $result
        );

    }

    /**
     * @depends testValues
     */
    function testMonthlyByDay() {

        $ev = new Component('VEVENT');
        $ev->UID = 'bla';
        $ev->RRULE = 'FREQ=MONTHLY;INTERVAL=2;COUNT=16;BYDAY=MO,-2TU,+1WE,3TH';
        $dtStart = new Property\DateTime('DTSTART');
        $dtStart->setDateTime(new DateTime('2011-01-03', new DateTimeZone('UTC')),Property\DateTime::UTC);

        $ev->add($dtStart);

        $vcal = Component::create('VCALENDAR');
        $vcal->add($ev);

        $it = new RecurrenceIterator($vcal,(string)$ev->uid);

        $this->assertEquals('monthly', $it->frequency);
        $this->assertEquals(2, $it->interval);
        $this->assertEquals(16, $it->count);
        $this->assertEquals(array('MO','-2TU','+1WE','3TH'), $it->byDay);

        $max = 20;
        $result = array();
        foreach($it as $k=>$item) {

            $result[] = $item;
            $max--;

            if (!$max) break;

        }

        $tz = new DateTimeZone('UTC');

        $this->assertEquals(
            array(
                new DateTime('2011-01-03', $tz),
                new DateTime('2011-01-05', $tz),
                new DateTime('2011-01-10', $tz),
                new DateTime('2011-01-17', $tz),
                new DateTime('2011-01-18', $tz),
                new DateTime('2011-01-20', $tz),
                new DateTime('2011-01-24', $tz),
                new DateTime('2011-01-31', $tz),
                new DateTime('2011-03-02', $tz),
                new DateTime('2011-03-07', $tz),
                new DateTime('2011-03-14', $tz),
                new DateTime('2011-03-17', $tz),
                new DateTime('2011-03-21', $tz),
                new DateTime('2011-03-22', $tz),
                new DateTime('2011-03-28', $tz),
                new DateTime('2011-05-02', $tz),
            ),
            $result
        );

    }

    /**
     * @depends testValues
     */
    function testMonthlyByDayByMonthDay() {

        $ev = new Component('VEVENT');
        $ev->UID = 'bla';
        $ev->RRULE = 'FREQ=MONTHLY;COUNT=10;BYDAY=MO;BYMONTHDAY=1';
        $dtStart = new Property\DateTime('DTSTART');
        $dtStart->setDateTime(new DateTime('2011-08-01', new DateTimeZone('UTC')),Property\DateTime::UTC);

        $ev->add($dtStart);

        $vcal = Component::create('VCALENDAR');
        $vcal->add($ev);

        $it = new RecurrenceIterator($vcal,(string)$ev->uid);

        $this->assertEquals('monthly', $it->frequency);
        $this->assertEquals(1, $it->interval);
        $this->assertEquals(10, $it->count);
        $this->assertEquals(array('MO'), $it->byDay);
        $this->assertEquals(array(1), $it->byMonthDay);

        $max = 20;
        $result = array();
        foreach($it as $k=>$item) {

            $result[] = $item;
            $max--;

            if (!$max) break;

        }

        $tz = new DateTimeZone('UTC');

        $this->assertEquals(
            array(
                new DateTime('2011-08-01', $tz),
                new DateTime('2012-10-01', $tz),
                new DateTime('2013-04-01', $tz),
                new DateTime('2013-07-01', $tz),
                new DateTime('2014-09-01', $tz),
                new DateTime('2014-12-01', $tz),
                new DateTime('2015-06-01', $tz),
                new DateTime('2016-02-01', $tz),
                new DateTime('2016-08-01', $tz),
                new DateTime('2017-05-01', $tz),
            ),
            $result
        );

    }

    /**
     * @depends testValues
     */
    function testMonthlyByDayBySetPos() {

        $ev = new Component('VEVENT');
        $ev->UID = 'bla';
        $ev->RRULE = 'FREQ=MONTHLY;COUNT=10;BYDAY=MO,TU,WE,TH,FR;BYSETPOS=1,-1';
        $dtStart = new Property\DateTime('DTSTART');
        $dtStart->setDateTime(new DateTime('2011-01-03', new DateTimeZone('UTC')),Property\DateTime::UTC);

        $ev->add($dtStart);

        $vcal = Component::create('VCALENDAR');
        $vcal->add($ev);

        $it = new RecurrenceIterator($vcal,(string)$ev->uid);

        $this->assertEquals('monthly', $it->frequency);
        $this->assertEquals(1, $it->interval);
        $this->assertEquals(10, $it->count);
        $this->assertEquals(array('MO','TU','WE','TH','FR'), $it->byDay);
        $this->assertEquals(array(1,-1), $it->bySetPos);

        $max = 20;
        $result = array();
        foreach($it as $k=>$item) {

            $result[] = $item;
            $max--;

            if (!$max) break;

        }

        $tz = new DateTimeZone('UTC');

        $this->assertEquals(
            array(
                new DateTime('2011-01-03', $tz),
                new DateTime('2011-01-31', $tz),
                new DateTime('2011-02-01', $tz),
                new DateTime('2011-02-28', $tz),
                new DateTime('2011-03-01', $tz),
                new DateTime('2011-03-31', $tz),
                new DateTime('2011-04-01', $tz),
                new DateTime('2011-04-29', $tz),
                new DateTime('2011-05-02', $tz),
                new DateTime('2011-05-31', $tz),
            ),
            $result
        );

    }

    /**
     * @depends testValues
     */
    function testYearly() {

        $ev = new Component('VEVENT');
        $ev->UID = 'bla';
        $ev->RRULE = 'FREQ=YEARLY;COUNT=10;INTERVAL=3';
        $dtStart = new Property\DateTime('DTSTART');
        $dtStart->setDateTime(new DateTime('2011-01-01', new DateTimeZone('UTC')),Property\DateTime::UTC);

        $ev->add($dtStart);

        $vcal = Component::create('VCALENDAR');
        $vcal->add($ev);

        $it = new RecurrenceIterator($vcal,(string)$ev->uid);

        $this->assertEquals('yearly', $it->frequency);
        $this->assertEquals(3, $it->interval);
        $this->assertEquals(10, $it->count);

        $max = 20;
        $result = array();
        foreach($it as $k=>$item) {

            $result[] = $item;
            $max--;

            if (!$max) break;

        }

        $tz = new DateTimeZone('UTC');

        $this->assertEquals(
            array(
                new DateTime('2011-01-01', $tz),
                new DateTime('2014-01-01', $tz),
                new DateTime('2017-01-01', $tz),
                new DateTime('2020-01-01', $tz),
                new DateTime('2023-01-01', $tz),
                new DateTime('2026-01-01', $tz),
                new DateTime('2029-01-01', $tz),
                new DateTime('2032-01-01', $tz),
                new DateTime('2035-01-01', $tz),
                new DateTime('2038-01-01', $tz),
            ),
            $result
        );

    }

    /**
     * @depends testValues
     */
    function testYearlyLeapYear() {

        $ev = new Component('VEVENT');
        $ev->UID = 'bla';
        $ev->RRULE = 'FREQ=YEARLY;COUNT=3';
        $dtStart = new Property\DateTime('DTSTART');
        $dtStart->setDateTime(new DateTime('2012-02-29', new DateTimeZone('UTC')),Property\DateTime::UTC);

        $ev->add($dtStart);

        $vcal = Component::create('VCALENDAR');
        $vcal->add($ev);

        $it = new RecurrenceIterator($vcal,(string)$ev->uid);

        $this->assertEquals('yearly', $it->frequency);
        $this->assertEquals(3, $it->count);

        $max = 20;
        $result = array();
        foreach($it as $k=>$item) {

            $result[] = $item;
            $max--;

            if (!$max) break;

        }

        $tz = new DateTimeZone('UTC');

        $this->assertEquals(
            array(
                new DateTime('2012-02-29', $tz),
                new DateTime('2016-02-29', $tz),
                new DateTime('2020-02-29', $tz),
            ),
            $result
        );

    }

    /**
     * @depends testValues
     */
    function testYearlyByMonth() {

        $ev = new Component('VEVENT');
        $ev->UID = 'bla';
        $ev->RRULE = 'FREQ=YEARLY;COUNT=8;INTERVAL=4;BYMONTH=4,10';
        $dtStart = new Property\DateTime('DTSTART');
        $dtStart->setDateTime(new DateTime('2011-04-07', new DateTimeZone('UTC')),Property\DateTime::UTC);

        $ev->add($dtStart);

        $vcal = Component::create('VCALENDAR');
        $vcal->add($ev);

        $it = new RecurrenceIterator($vcal,(string)$ev->uid);

        $this->assertEquals('yearly', $it->frequency);
        $this->assertEquals(4, $it->interval);
        $this->assertEquals(8, $it->count);
        $this->assertEquals(array(4,10), $it->byMonth);

        $max = 20;
        $result = array();
        foreach($it as $k=>$item) {

            $result[] = $item;
            $max--;

            if (!$max) break;

        }

        $tz = new DateTimeZone('UTC');

        $this->assertEquals(
            array(
                new DateTime('2011-04-07', $tz),
                new DateTime('2011-10-07', $tz),
                new DateTime('2015-04-07', $tz),
                new DateTime('2015-10-07', $tz),
                new DateTime('2019-04-07', $tz),
                new DateTime('2019-10-07', $tz),
                new DateTime('2023-04-07', $tz),
                new DateTime('2023-10-07', $tz),
            ),
            $result
        );

    }

    /**
     * @depends testValues
     */
    function testYearlyByMonthByDay() {

        $ev = new Component('VEVENT');
        $ev->UID = 'bla';
        $ev->RRULE = 'FREQ=YEARLY;COUNT=8;INTERVAL=5;BYMONTH=4,10;BYDAY=1MO,-1SU';
        $dtStart = new Property\DateTime('DTSTART');
        $dtStart->setDateTime(new DateTime('2011-04-04', new DateTimeZone('UTC')),Property\DateTime::UTC);

        $ev->add($dtStart);

        $vcal = Component::create('VCALENDAR');
        $vcal->add($ev);

        $it = new RecurrenceIterator($vcal,(string)$ev->uid);

        $this->assertEquals('yearly', $it->frequency);
        $this->assertEquals(5, $it->interval);
        $this->assertEquals(8, $it->count);
        $this->assertEquals(array(4,10), $it->byMonth);
        $this->assertEquals(array('1MO','-1SU'), $it->byDay);

        $max = 20;
        $result = array();
        foreach($it as $k=>$item) {

            $result[] = $item;
            $max--;

            if (!$max) break;

        }

        $tz = new DateTimeZone('UTC');

        $this->assertEquals(
            array(
                new DateTime('2011-04-04', $tz),
                new DateTime('2011-04-24', $tz),
                new DateTime('2011-10-03', $tz),
                new DateTime('2011-10-30', $tz),
                new DateTime('2016-04-04', $tz),
                new DateTime('2016-04-24', $tz),
                new DateTime('2016-10-03', $tz),
                new DateTime('2016-10-30', $tz),
            ),
            $result
        );

    }

    /**
     * @depends testValues
     */
    function testFastForward() {

        $ev = new Component('VEVENT');
        $ev->UID = 'bla';
        $ev->RRULE = 'FREQ=YEARLY;COUNT=8;INTERVAL=5;BYMONTH=4,10;BYDAY=1MO,-1SU';
        $dtStart = new Property\DateTime('DTSTART');
        $dtStart->setDateTime(new DateTime('2011-04-04', new DateTimeZone('UTC')),Property\DateTime::UTC);

        $ev->add($dtStart);

        $vcal = Component::create('VCALENDAR');
        $vcal->add($ev);

        $it = new RecurrenceIterator($vcal,(string)$ev->uid);

        // The idea is that we're fast-forwarding too far in the future, so
        // there will be no results left.
        $it->fastForward(new DateTime('2020-05-05', new DateTimeZone('UTC')));

        $max = 20;
        $result = array();
        while($item = $it->current()) {

            $result[] = $item;
            $max--;

            if (!$max) break;
            $it->next();

        }

        $tz = new DateTimeZone('UTC');
        $this->assertEquals(array(), $result);

    }

    /**
     * @depends testValues
     */
    function testComplexExclusions() {

        $ev = new Component('VEVENT');
        $ev->UID = 'bla';
        $ev->RRULE = 'FREQ=YEARLY;COUNT=10';
        $dtStart = new Property\DateTime('DTSTART');

        $tz = new DateTimeZone('Canada/Eastern');
        $dtStart->setDateTime(new DateTime('2011-01-01 13:50:20', $tz),Property\DateTime::LOCALTZ);

        $exDate1 = new Property\MultiDateTime('EXDATE');
        $exDate1->setDateTimes(array(new DateTime('2012-01-01 13:50:20', $tz), new DateTime('2014-01-01 13:50:20', $tz)), Property\DateTime::LOCALTZ);
        $exDate2 = new Property\MultiDateTime('EXDATE');
        $exDate2->setDateTimes(array(new DateTime('2016-01-01 13:50:20', $tz)), Property\DateTime::LOCALTZ);

        $ev->add($dtStart);
        $ev->add($exDate1);
        $ev->add($exDate2);

        $vcal = Component::create('VCALENDAR');
        $vcal->add($ev);

        $it = new RecurrenceIterator($vcal,(string)$ev->uid);

        $this->assertEquals('yearly', $it->frequency);
        $this->assertEquals(1, $it->interval);
        $this->assertEquals(10, $it->count);

        $max = 20;
        $result = array();
        foreach($it as $k=>$item) {

            $result[] = $item;
            $max--;

            if (!$max) break;

        }

        $this->assertEquals(
            array(
                new DateTime('2011-01-01 13:50:20', $tz),
                new DateTime('2013-01-01 13:50:20', $tz),
                new DateTime('2015-01-01 13:50:20', $tz),
                new DateTime('2017-01-01 13:50:20', $tz),
                new DateTime('2018-01-01 13:50:20', $tz),
                new DateTime('2019-01-01 13:50:20', $tz),
                new DateTime('2020-01-01 13:50:20', $tz),
            ),
            $result
        );

    }

    /**
     * @depends testValues
     */
    function testOverridenEvent() {

        $vcal = Component::create('VCALENDAR');

        $ev1 = Component::create('VEVENT');
        $ev1->UID = 'overridden';
        $ev1->RRULE = 'FREQ=DAILY;COUNT=10';
        $ev1->DTSTART = '20120107T120000Z';
        $ev1->SUMMARY = 'baseEvent';

        $vcal->add($ev1);

        // ev2 overrides an event, and puts it on 2pm instead.
        $ev2 = Component::create('VEVENT');
        $ev2->UID = 'overridden';
        $ev2->{'RECURRENCE-ID'} = '20120110T120000Z';
        $ev2->DTSTART = '20120110T140000Z';
        $ev2->SUMMARY = 'Event 2';

        $vcal->add($ev2);

        // ev3 overrides an event, and puts it 2 days and 2 hours later 
        $ev3 = Component::create('VEVENT');
        $ev3->UID = 'overridden';
        $ev3->{'RECURRENCE-ID'} = '20120113T120000Z';
        $ev3->DTSTART = '20120115T140000Z';
        $ev3->SUMMARY = 'Event 3';

        $vcal->add($ev3);

        $it = new RecurrenceIterator($vcal,'overridden');

        $dates = array();
        $summaries = array();
        while($it->valid()) {

            $dates[] = $it->getDTStart();
            $summaries[] = (string)$it->getEventObject()->SUMMARY;
            $it->next();

        }

        $tz = new DateTimeZone('GMT');
        $this->assertEquals(array(
            new DateTime('2012-01-07 12:00:00',$tz),
            new DateTime('2012-01-08 12:00:00',$tz),
            new DateTime('2012-01-09 12:00:00',$tz),
            new DateTime('2012-01-10 14:00:00',$tz),
            new DateTime('2012-01-11 12:00:00',$tz),
            new DateTime('2012-01-12 12:00:00',$tz),
            new DateTime('2012-01-14 12:00:00',$tz),
            new DateTime('2012-01-15 12:00:00',$tz),
            new DateTime('2012-01-15 14:00:00',$tz),
            new DateTime('2012-01-16 12:00:00',$tz),
        ), $dates);

        $this->assertEquals(array(
            'baseEvent',
            'baseEvent',
            'baseEvent',
            'Event 2',
            'baseEvent',
            'baseEvent',
            'baseEvent',
            'baseEvent',
            'Event 3',
            'baseEvent',
        ), $summaries);

    }

    /**
     * @depends testValues
     */
    function testOverridenEvent2() {

        $vcal = Component::create('VCALENDAR');

        $ev1 = Component::create('VEVENT');
        $ev1->UID = 'overridden';
        $ev1->RRULE = 'FREQ=WEEKLY;COUNT=3';
        $ev1->DTSTART = '20120112T120000Z';
        $ev1->SUMMARY = 'baseEvent';

        $vcal->add($ev1);

        // ev2 overrides an event, and puts it 6 days earlier instead.
        $ev2 = Component::create('VEVENT');
        $ev2->UID = 'overridden';
        $ev2->{'RECURRENCE-ID'} = '20120119T120000Z';
        $ev2->DTSTART = '20120113T120000Z';
        $ev2->SUMMARY = 'Override!';

        $vcal->add($ev2);

        $it = new RecurrenceIterator($vcal,'overridden');

        $dates = array();
        $summaries = array();
        while($it->valid()) {

            $dates[] = $it->getDTStart();
            $summaries[] = (string)$it->getEventObject()->SUMMARY;
            $it->next();

        }

        $tz = new DateTimeZone('GMT');
        $this->assertEquals(array(
            new DateTime('2012-01-12 12:00:00',$tz),
            new DateTime('2012-01-13 12:00:00',$tz),
            new DateTime('2012-01-26 12:00:00',$tz),

        ), $dates);

        $this->assertEquals(array(
            'baseEvent',
            'Override!',
            'baseEvent',
        ), $summaries);

    }

    /**
     * @depends testValues
     */
    function testOverridenEventNoValuesExpected() {

        $vcal = Component::create('VCALENDAR');

        $ev1 = Component::create('VEVENT');
        $ev1->UID = 'overridden';
        $ev1->RRULE = 'FREQ=WEEKLY;COUNT=3';
        $ev1->DTSTART = '20120124T120000Z';
        $ev1->SUMMARY = 'baseEvent';

        $vcal->add($ev1);

        // ev2 overrides an event, and puts it 6 days earlier instead.
        $ev2 = Component::create('VEVENT');
        $ev2->UID = 'overridden';
        $ev2->{'RECURRENCE-ID'} = '20120131T120000Z';
        $ev2->DTSTART = '20120125T120000Z';
        $ev2->SUMMARY = 'Override!';

        $vcal->add($ev2);

        $it = new RecurrenceIterator($vcal,'overridden');

        $dates = array();
        $summaries = array();

        // The reported problem was specifically related to the VCALENDAR 
        // expansion. In this parcitular case, we had to forward to the 28th of 
        // january.
        $it->fastForward(new DateTime('2012-01-28 23:00:00'));

        // We stop the loop when it hits the 6th of februari. Normally this 
        // iterator would hit 24, 25 (overriden from 31) and 7 feb but because 
        // we 'filter' from the 28th till the 6th, we should get 0 results.
        while($it->valid() && $it->getDTSTart() < new DateTime('2012-02-06 23:00:00')) {

            $dates[] = $it->getDTStart();
            $summaries[] = (string)$it->getEventObject()->SUMMARY;
            $it->next();

        }

        $this->assertEquals(array(), $dates);
        $this->assertEquals(array(), $summaries);

    }
}

