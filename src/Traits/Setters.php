<?php

/**
 * This file is part of consoletvs/invoices.
 *
 * (c) Erik Campobadal <soc@erik.cat>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eavio\Invoices\Traits;

use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * This is the Setters trait.
 *
 * @author Erik Campobadal <soc@erik.cat>
 */
trait Setters
{
    /**
     * Set the invoice discount.
     *
     * @method discount
     *
     * @param int $discount
     *
     * @return self
     */
    public function discount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Set the invoice footer logo.
     *
     * @method footer_logo
     *
     * @param string $footer_logo
     *
     * @return self
     */
    public function footer_logo($footer_logo)
    {
        $this->footer_logo = $footer_logo;

        return $this;
    }

    /**
     * Set the invoice date of service.
     *
     * @method date_of_service
     *
     * @param Carbon $date_of_service
     *
     * @return self
     */
    public function date_of_service($date_of_service)
    {
        $this->date_of_service = $date_of_service;

        return $this;
    }

    /**
     * Set the invoice tax number.
     *
     * @method tax_number
     *
     * @param string $tax_number
     *
     * @return self
     */
    public function tax_number($tax_number)
    {
        $this->tax_number = $tax_number;

        return $this;
    }

    /**
     * Set the invoice name.
     *
     * @method name
     *
     * @param string $name
     *
     * @return self
     */
    public function name($name)
    {
        $this->name = $name;

        return $this;
    }


    /**
     * Set the invoice has_units.
     *
     * @method has_units
     *
     * @param string $has_units
     *
     * @return self
     */
    public function has_units($has_units)
    {
        $this->has_units = $has_units;

        return $this;
    }

    /**
     * Set the invoice type.
     *
     * @method type
     *
     * @param string $type
     *
     * @return self
     */
    public function type($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Set the invoice type.
     *
     * @method type
     *
     * @param string $type
     *
     * @return self
     */
    public function section($section)
    {
        $this->section = $section;

        return $this;
    }


    /**
     * Set the invoice number.
     *
     * @method number
     *
     * @param int $number
     *
     * @return self
     */
    public function number($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Set the invoice decimal precision.
     *
     * @method decimals
     *
     * @param int $decimals
     *
     * @return self
     */
    public function decimals($decimals)
    {
        $this->decimals = $decimals;

        return $this;
    }

    /**
     * Set the invoice logo URL.
     *
     * @method logo
     *
     * @param string $logo_url
     *
     * @return self
     */
    public function logo($logo_url)
    {
        $this->logo = $logo_url;

        return $this;
    }

    /**
     * Set the invoice date.
     *
     * @method date
     *
     * @param Carbon $date
     *
     * @return self
     */
    public function date(Carbon $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Set the invoice notes.
     *
     * @method notes
     *
     * @param string $notes
     *
     * @return self
     */
    public function notes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Set the invoice business details.
     *
     * @method business
     *
     * @param array $details
     *
     * @return self
     */
    public function business($details)
    {
        $this->business_details = Collection::make($details);

        return $this;
    }

    /**
     * Set the invoice customer details.
     *
     * @method customer
     *
     * @param array $details
     *
     * @return self
     */
    public function customer($details)
    {
        $this->customer_details = Collection::make($details);

        return $this;
    }

    /**
     * Set the invoice currency.
     *
     * @method currency
     *
     * @param string $currency
     *
     * @return self
     */
    public function currency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Set the invoice footnote.
     *
     * @method footnote
     *
     * @param string $footnote
     *
     * @return self
     */
    public function footnote($footnote)
    {
        $this->footnote = $footnote;

        return $this;
    }

    /**
     * Set the invoice due date.
     *
     * @method due_date
     *
     * @param Carbon $due_date
     *
     * @return self
     */
    public function due_date(Carbon $due_date = null)
    {
        $this->due_date = $due_date;
        return $this;
    }

    /**
     * Show/hide the invoice pagination.
     *
     * @method with_pagination
     *
     * @param boolean $with_pagination
     *
     * @return self
     */
    public function with_pagination($with_pagination)
    {
        $this->with_pagination = $with_pagination;
        return $this;
    }

    /**
     * Duplicate the header on each page.
     *
     * @method duplicate_header
     *
     * @param boolean $duplicate_header
     *
     * @return self
     */
    public function duplicate_header($duplicate_header)
    {
        $this->duplicate_header = $duplicate_header;
        return $this;
    }
}
