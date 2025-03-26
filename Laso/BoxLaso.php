<?php
/**
 * Created by PhpStorm.
 * User: DUYDUC
 * Date: 28-May-21
 * Time: 3:29 PM
 */

namespace Laven;

use GDText\Box;
use GDText\TextWrapping;
use GDText\VerticalAlignment;
use GDText\HorizontalAlignment;


class BoxLaso extends Box
{
	public function draw($text)
	{
		if (!isset($this->fontFace)) {
			throw new \InvalidArgumentException('No path to font file has been specified.');
		}

		switch ($this->textWrapping) {
			case TextWrapping::NoWrap:
				$lines = array($text);
				break;
			case TextWrapping::WrapWithOverflow:
			default:
				$lines = $this->wrapTextWithOverflow($text);
				break;
		}

		if ($this->debug) {
			// Marks whole texbox area with color
			$this->drawFilledRectangle(
				$this->box['x'],
				$this->box['y'],
				$this->box['width'],
				$this->box['height'],
				new Color(rand(180, 255), rand(180, 255), rand(180, 255), 80)
			);
		}

		$lineHeightPx = $this->lineHeight * $this->fontSize;
		$textHeight = count($lines) * $lineHeightPx;

		switch ($this->alignY) {
			case VerticalAlignment::Center:
				$yAlign = ($this->box['height'] / 2) - ($textHeight / 2);
				break;
			case VerticalAlignment::Bottom:
				$yAlign = $this->box['height'] - $textHeight;
				break;
			case VerticalAlignment::Top:
			default:
				$yAlign = 0;
		}

		$n = 0;
		foreach ($lines as $line) {
			$box = $this->calculateBox($line);
			$boxWidth = $box[2] - $box[0];
			switch ($this->alignX) {
				case HorizontalAlignment::Center:
					$xAlign = ($this->box['width'] - $boxWidth) / 2;
					break;
				case HorizontalAlignment::Right:
					$xAlign = ($this->box['width'] - $boxWidth);
					break;
				case HorizontalAlignment::Left:
				default:
					$xAlign = 0;
			}
			$yShift = $lineHeightPx * (1 - $this->baseline);

			// current line X and Y position
			$xMOD = $this->box['x'] + $xAlign;
			$yMOD = $this->box['y'] + $yAlign + $yShift + ($n * $lineHeightPx);

			if ($line && $this->backgroundColor) {
				// Marks whole texbox area with given background-color
				$backgroundHeight = $this->fontSize + 5;

				$this->drawFilledRectangle(
					$xMOD,
					$this->box['y'] + $yAlign + ($n * $lineHeightPx) + ($lineHeightPx - $backgroundHeight) + (1 - $this->lineHeight) * 13 * (1 / 50 * $this->fontSize),
					$boxWidth,
					$backgroundHeight,
					$this->backgroundColor
				);
			}

			if ($this->debug) {
				// Marks current line with color
				$this->drawFilledRectangle(
					$xMOD,
					$this->box['y'] + $yAlign + ($n * $lineHeightPx),
					$boxWidth,
					$lineHeightPx,
					new Color(rand(1, 180), rand(1, 180), rand(1, 180))
				);
			}

			if ($this->textShadow !== false) {
				$this->drawInternal(
					$xMOD + $this->textShadow['x'],
					$yMOD + $this->textShadow['y'],
					$this->textShadow['color'],
					$line
				);

			}

			$this->strokeText($xMOD, $yMOD, $line);
			$this->drawInternal(
				$xMOD,
				$yMOD,
				$this->fontColor,
				$line
			);

			$n++;
		}
	}
}