import { AppSidebar } from "./App/AppSidebar"
import { AppHeader } from "./App/AppHeader"
import { SidebarInset, SidebarProvider } from "@/shadcn/ui/sidebar"

export default function AppLayout({ children }) {
	return (
		<SidebarProvider defaultOpen>
			<div className="flex min-h-screen w-full">
				<AppSidebar />
				<SidebarInset className="flex w-full flex-col">
					<AppHeader />
					<div className="container mx-auto flex-1 overflow-auto">
						{children}
					</div>
				</SidebarInset>
			</div>
		</SidebarProvider>
	)
}

