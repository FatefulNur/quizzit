"use client"

import { Search } from 'lucide-react'

import { Input } from "@/shadcn/ui/input"
import { SidebarTrigger } from "@/shadcn/ui/sidebar"

export function AppHeader() {
  return (
    <header className="p-3 border-b sticky top-0 z-50">
			<div className="container mx-auto flex items-center gap-4">
				<div className="absolute left-0 top-0 size-full backdrop-blur-2xl"></div>
				<div className="relative flex items-center gap-4">
					<SidebarTrigger />
					<div className="flex items-center gap-2">
						<div className="h-6 w-6 rounded bg-primary" />
						<span className="font-semibold">Forms</span>
					</div>
				</div>
				<div className="flex-1">
					<div className="mx-auto max-w-2xl">
						<div className="relative">
							<Search className="absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-muted-foreground" />
							<Input
								type="search"
								placeholder="Search forms..."
								className="w-full h-12 pl-12 rounded-full bg-white"
							/>
						</div>
					</div>
				</div>
			</div>
    </header>
  )
}

