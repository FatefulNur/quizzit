"use client"

import { FileText, FolderOpen, Home, Plus, Star } from 'lucide-react'

import {
  Sidebar,
  SidebarContent,
  SidebarGroup,
  SidebarGroupContent,
  SidebarGroupLabel,
  SidebarHeader,
  SidebarMenu,
  SidebarMenuButton,
  SidebarMenuItem,
  SidebarRail,
} from "@/shadcn/ui/sidebar"

const navigation = [
  {
    title: "Home",
    icon: Home,
    href: "/",
    isActive: true,
  },
  {
    title: "All Forms",
    icon: FileText,
    href: "/forms",
  },
  {
    title: "Starred",
    icon: Star,
    href: "/starred",
  },
  {
    title: "Folders",
    icon: FolderOpen,
    href: "/folders",
  },
]

export function AppSidebar() {
  return (
    <Sidebar>
      <SidebarHeader>
        <SidebarMenu>
          <SidebarMenuItem>
            <SidebarMenuButton size="lg" asChild>
              <button className="w-full">
                <Plus className="h-4 w-4" />
                <span>New Form</span>
              </button>
            </SidebarMenuButton>
          </SidebarMenuItem>
        </SidebarMenu>
      </SidebarHeader>
      <SidebarContent>
        <SidebarGroup>
          <SidebarGroupLabel>Navigation</SidebarGroupLabel>
          <SidebarGroupContent>
            <SidebarMenu>
              {navigation.map((item) => (
                <SidebarMenuItem key={item.href}>
                  <SidebarMenuButton asChild isActive={item.isActive}>
                    <a href={item.href}>
                      <item.icon className="h-4 w-4" />
                      <span>{item.title}</span>
                    </a>
                  </SidebarMenuButton>
                </SidebarMenuItem>
              ))}
            </SidebarMenu>
          </SidebarGroupContent>
        </SidebarGroup>
      </SidebarContent>
      <SidebarRail />
    </Sidebar>
  )
}

