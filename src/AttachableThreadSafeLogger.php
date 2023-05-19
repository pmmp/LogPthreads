<?php

/*
 * PocketMine Standard PHP Library
 * Copyright (C) 2014-2018 PocketMine Team <https://github.com/PocketMine/PocketMine-SPL>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
*/

use pmmp\thread\ThreadSafeArray;

abstract class AttachableThreadSafeLogger extends \ThreadSafeLogger{

	/**
	 * @var ThreadSafeArray|\ThreadSafeLoggerAttachment[]
	 * @phpstan-var ThreadSafeArray<int, \ThreadSafeLoggerAttachment>
	 */
	protected $attachments;

	public function __construct(){
		$this->attachments = new ThreadSafeArray();
	}

	/**
	 * @param ThreadSafeLoggerAttachment $attachment
	 *
	 * @return void
	 */
	public function addAttachment(\ThreadSafeLoggerAttachment $attachment){
		$this->attachments[] = $attachment;
	}

	/**
	 * @param ThreadSafeLoggerAttachment $attachment
	 *
	 * @return void
	 */
	public function removeAttachment(\ThreadSafeLoggerAttachment $attachment){
		foreach($this->attachments as $i => $a){
			if($attachment === $a){
				unset($this->attachments[$i]);
			}
		}
	}

	/**
	 * @return void
	 */
	public function removeAttachments(){
		foreach($this->attachments as $i => $a){
			unset($this->attachments[$i]);
		}
	}

	/**
	 * @return \ThreadSafeLoggerAttachment[]
	 */
	public function getAttachments(){
		return (array) $this->attachments;
	}
}
